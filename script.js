document.addEventListener("DOMContentLoaded", () => {
    // Bouton pour démarrer le traitement
    document.getElementById("process-btn").addEventListener("click", () => {
        alert("Processing started...");
        fetch("process_images.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ action: "start_processing" }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Processing completed successfully!");
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch((error) => console.error("Error:", error));
    });

    // Boutons de navigation
    document.getElementById("image-preprocessing-btn").addEventListener("click", () => {
        window.location.href = "preprocessing.html";
    });

    document.getElementById("automated-classification-btn").addEventListener("click", () => {
        alert("Automated Classification selected!");
    });

    document.getElementById("model-evaluation-btn").addEventListener("click", () => {
        window.location.href = "evaluation.html";
    });
});
