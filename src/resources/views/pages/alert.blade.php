<script>
    document.addEventListener("DOMContentLoaded", function () {
        Livewire.on('success', (message) => {
            Toastify({
                escapeMarkup: false,
                text: '<i class="fas fa-check-circle mr-2"></i> ' + message,
                duration: 3000,
                gravity: "top",
                position: "center",
                style: {
                    background: "linear-gradient(135deg, #2ecc71, #27ae60)",
                    fontWeight: "600",
                    textTransform: "uppercase",
                    padding: "12px 20px",
                },
            }).showToast();
        });

        Livewire.on('error', (message) => {
            Toastify({
                escapeMarkup: false,
                text: '<i class="fas fa-exclamation-circle mr-3" style="font-size:20px;"></i>' + message,
                duration: 3000,
                gravity: "top",
                position: "center",
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    fontWeight: "600",
                    textTransform: "uppercase",
                    padding: "12px 20px",
                },
            }).showToast();
        });
    });
</script>
