import sys
import os
import tensorflow as tf
from tensorflow import keras
import matplotlib.pyplot as plt

# Retrieve command-line arguments
args = sys.argv[1:]
if len(args) < 6:
    print("Error: Not enough arguments provided.")
    sys.exit(1)

# Extract hyperparameters
learning_rate = float(args[0])
batch_size = int(args[1])
epochs = int(args[2])
dropout_rate = float(args[3])
optimizer_name = args[4]
loss_function = args[5]

# Define paths
upload_dir = 'uploads/'
result_dir = 'results/'
graph_file = os.path.join(result_dir, 'graph.png')
output_file = os.path.join(result_dir, 'output.txt')

# Ensure the results directory exists
os.makedirs(result_dir, exist_ok=True)

# Prepare the dataset
img_size = 224
try:
    dataset = tf.keras.preprocessing.image_dataset_from_directory(
        upload_dir,
        image_size=(img_size, img_size),
        batch_size=batch_size,
        label_mode='categorical'
    )
except Exception as e:
    with open(output_file, 'w') as f:
        f.write(f"Error loading dataset: {str(e)}")
    sys.exit(1)

# Build a CNN model
model = keras.Sequential([
    keras.layers.Rescaling(1./255, input_shape=(img_size, img_size, 3)),
    keras.layers.Conv2D(32, (3, 3), activation='relu'),
    keras.layers.MaxPooling2D(),
    keras.layers.Conv2D(64, (3, 3), activation='relu'),
    keras.layers.MaxPooling2D(),
    keras.layers.Flatten(),
    keras.layers.Dense(128, activation='relu'),
    keras.layers.Dropout(dropout_rate),
    keras.layers.Dense(len(dataset.class_names), activation='softmax')
])

# Choose optimizer
if optimizer_name.lower() == 'adam':
    optimizer = keras.optimizers.Adam(learning_rate)
elif optimizer_name.lower() == 'sgd':
    optimizer = keras.optimizers.SGD(learning_rate)
else:
    optimizer = keras.optimizers.Adam(learning_rate)

# Compile the model
model.compile(optimizer=optimizer, loss=loss_function, metrics=['accuracy'])

# Train the model
history = model.fit(dataset, epochs=epochs)

# Save the results
with open(output_file, 'w') as f:
    f.write(f"Training completed successfully.\n")
    f.write(f"Epochs: {epochs}, Batch Size: {batch_size}\n")
    f.write(f"Learning Rate: {learning_rate}, Dropout Rate: {dropout_rate}\n")
    f.write(f"Optimizer: {optimizer_name}, Loss Function: {loss_function}\n")
    f.write(f"Class Names: {', '.join(dataset.class_names)}\n")

# Plot the training performance
plt.figure(figsize=(8, 6))
plt.plot(history.history['accuracy'], label='Accuracy')
plt.plot(history.history['loss'], label='Loss')
plt.title('Training Performance')
plt.xlabel('Epochs')
plt.ylabel('Value')
plt.legend()
plt.grid(True)
plt.savefig(graph_file)

# Print success message
print("Processing completed. Results saved.")
