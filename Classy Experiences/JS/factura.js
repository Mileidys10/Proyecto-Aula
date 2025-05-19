function descargarPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            let y = 20;
            doc.setFontSize(16);
            doc.text("Factura de Compra", 20, y);

            y += 10;
            doc.setFontSize(12);
            doc.text(document.getElementById('factura-nombre').textContent, 20, y);
            y += 8;
            doc.text(document.getElementById('factura-fecha').textContent, 20, y);
            y += 10;

            const items = document.querySelectorAll('#factura-items li');
            items.forEach(item => {
                doc.text(item.textContent, 20, y);
                y += 8;
            });

            y += 5;
            doc.text(document.getElementById('factura-total').textContent, 20, y);

            doc.save("factura.pdf");
        }