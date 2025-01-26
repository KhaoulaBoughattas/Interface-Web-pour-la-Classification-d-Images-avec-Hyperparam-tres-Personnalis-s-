import argparse
import os
import tensorflow as tf
import tensorflow_hub as hub
from tensorflow.keras.callbacks import ModelCheckpoint, EarlyStopping, ReduceLROnPlateau

def main(args):
    # Hyperparameters from command line
    learning_rate = args.learning_rate
    epochs = args.epochs
    patience = args.patience
    monitor_metric = args.monitor
    optimizer_name = args.optimizer
    model_name = args.model_name
    activation_function = args.activation_function
    validation_split = args.validation_split
    test_split = args.test_split
    image_directory = args.image_directory

    img_size = 224
    batch_size = 64

    # Load dataset
    train = tf.keras.utils.image_dataset_from_directory(
        image_directory,
        validation_split=validation_split,
        subset="training",
        seed=123,
        image_size=(img_size, img_size),
        batch_size=batch_size,
        label_mode="categorical"
    )

    val = tf.keras.utils.image_dataset_from_directory(
        image_directory,
        validation_split=validation_split,
        subset="validation",
        seed=123,
        image_size=(img_size, img_size),
        batch_size=batch_size,
        label_mode="categorical"
    )

    # Build the model
    Model_URL = 'https://tfhub.dev/google/imagenet/resnet_v2_50/feature_vector/5'
    model = tf.keras.Sequential([
        tf.keras.layers.Rescaling(1./255, input_shape=(img_size, img_size, 3)),
        hub.KerasLayer(Model_URL, trainable=False),
        tf.keras.layers.Dense(len(train.class_names), activation=activation_function)
    ])

    optimizer = {
        'Adam': tf.keras.optimizers.Adam(learning_rate=learning_rate),
        'SGD': tf.keras.optimizers.SGD(learning_rate=learning_rate)
    }[optimizer_name]

    model.compile(
        loss=tf.keras.losses.CategoricalCrossentropy(),
        optimizer=optimizer,
        metrics=["accuracy"]
    )

    model_name = f"{model_name}.h5"
    checkpoint = ModelCheckpoint(model_name, monitor=monitor_metric, mode="min", save_best_only=True, verbose=1)
    earlystopping = EarlyStopping(monitor=monitor_metric, patience=patience, restore_best_weights=True, verbose=1)
    reduce_lr = ReduceLROnPlateau(monitor=monitor_metric, factor=0.2, patience=3, min_lr=0.0001)

    # Train the model
    model.fit(
        train,
        epochs=epochs,
        validation_data=val,
        callbacks=[checkpoint, earlystopping, reduce_lr]
    )

    print("Training complete. Model saved as", model_name)

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Image Classification Training")
    parser.add_argument('--learning_rate', type=float, required=True)
    parser.add_argument('--epochs', type=int, required=True)
    parser.add_argument('--patience', type=int, required=True)
    parser.add_argument('--monitor', type=str, choices=["val_loss", "val_accuracy"], required=True)
    parser.add_argument('--optimizer', type=str, choices=["Adam", "SGD"], required=True)
    parser.add_argument('--model_name', type=str, required=True)
    parser.add_argument('--activation_function', type=str, choices=["Sigmoid", "ReLU", "Tanh", "Softmax"], required=True)
    parser.add_argument('--validation_split', type=float, required=True)
    parser.add_argument('--test_split', type=float, required=True)
    parser.add_argument('--image_directory', type=str, required=True)

    args = parser.parse_args()
    main(args)
