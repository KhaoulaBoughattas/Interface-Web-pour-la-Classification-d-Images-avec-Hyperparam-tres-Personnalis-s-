import sys

# Récupérer les arguments
learning_rate = float(sys.argv[1])
epochs = int(sys.argv[2])
patience = int(sys.argv[3])
monitor = sys.argv[4]
optimizer = sys.argv[5]
model_name = sys.argv[6]
activation_function = sys.argv[7]
validation_split = float(sys.argv[8])
test_split = float(sys.argv[9])
image_directory = sys.argv[10]

# Exemple de traitement
print(f"Starting training with the following parameters:")
print(f"Learning Rate: {learning_rate}")
print(f"Epochs: {epochs}")
print(f"Patience: {patience}")
print(f"Monitor: {monitor}")
print(f"Optimizer: {optimizer}")
print(f"Model Name: {model_name}")
print(f"Activation Function: {activation_function}")
print(f"Validation Split: {validation_split}")
print(f"Test Split: {test_split}")
print(f"Image Directory: {image_directory}")

# Ajoutez ici votre logique TensorFlow/Keras pour entraîner le modèle
