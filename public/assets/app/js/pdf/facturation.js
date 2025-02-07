$(document).ready(function () {

    window.PDF_Facturation= function (data) 
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

        const pdfFilename = "Facturation N° " + data.numfacture;
        doc.setProperties({
            title: pdfFilename,
        });

        let yPos = 10;

        function drawConsultationSection(yPos) {
            rightMargin = 15;
            leftMargin = 15;
            pdfWidth = doc.internal.pageSize.getWidth();

            const logoSrc = "assets/images/logo.jpg";
            const logoWidth = 30;
            const logoHeight = 15;
            doc.addImage(logoSrc, 'JPEG', leftMargin - 5, yPos , logoWidth, logoHeight);

            // Informations de l'entreprise
            doc.setFontSize(9);
            doc.setTextColor(0, 0, 0);
            doc.setFont("Helvetica", "bold");
            // Texte de l'entreprise
            const title = "JOB OPTIQUE";
            const titleWidth = doc.getTextWidth(title);
            const titleX = (doc.internal.pageSize.getWidth() - titleWidth) / 2;
            doc.text(title, titleX, yPos);
            // Texte de l'adresse
            doc.setFont("Helvetica", "normal");
            const address = "Siège social : Marcory Konankro face à l'école EPP TSF - 27 BP 659 Abidjan 27";
            const addressWidth = doc.getTextWidth(address);
            const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
            doc.text(address, addressX, (yPos + 5));
            // Texte du téléphone
            const phone = "Email: joboptique@gmail.com - Compte Bancaire : 121383458001 ecobank";
            const phoneWidth = doc.getTextWidth(phone);
            const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
            doc.text(phone, phoneX, (yPos + 9));

            const phone2 = "Tél.: +225 2720230558 / Cel.: +2250172972505 - RC No : CI-ABJ-2019-B-7745";
            const phoneWidth2 = doc.getTextWidth(phone2);
            const phoneX2 = (doc.internal.pageSize.getWidth() - phoneWidth2) / 2;
            doc.text(phone2, phoneX2, (yPos + 13));

            doc.setFontSize(30);
            doc.setLineWidth(0.3);
            doc.line(10, yPos + 20, 200, yPos + 20);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            const numDate = "01030900010216110 37 SIB";
            const numDateWidth = doc.getTextWidth(numDate);
            doc.text(numDate, (doc.internal.pageSize.getWidth() - numDateWidth) / 2, yPos + 25);

            yPoss = yPos + 35;

            const clientData = [
                ["N° C.C: 254862 G"],
                ["REGIME D'IMPOSITION: SYNTHETIQUE"],
                ["CENTRE DES IMPÔTS: PLATEAU"],
                ["FACTURE N° " + data.numfacture],
            ];

            doc.setFontSize(10);

            clientData.forEach((item, index) => {
                if (index === clientData.length - 1) {
                    doc.setFont("helvetica", "bold"); // Appliquer bold à la dernière ligne
                } else {
                    doc.setFont("helvetica", "normal"); // Normal pour les autres lignes
                }
                doc.text(item[0], leftMargin, yPoss + (index * 5) + 8);
            });


            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");
            const date = "Abidjan le " + new Date().toLocaleDateString();
            drawRightAlignedText(doc, date, yPoss + 16);

            doc.setFontSize(11);
            doc.setFont("helvetica", "bold");
            doc.text(data.assurance, leftMargin, yPoss + 40);

            doc.setFontSize(11);
            doc.setFont("helvetica", "bold");
            const dateText = data.societe;
            drawRightAlignedText(doc, dateText, yPoss + 40);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            const titre = "RECAPUTILTIF";
            const titreWidth = doc.getTextWidth(titre);
            doc.text(titre, (doc.internal.pageSize.getWidth() - titreWidth) / 2, yPoss + 55); 

            doc.autoTable({
                startY: yPoss + 65,
                head: [["DATE", "MATRICULE", "NOM", "MONTANT"]],
                body: [
                    [formatDate(data.datefacture), data.matricule_assurance,
                        data.client, data.partassurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa",],
                ],
                theme: "grid",
                headStyles: { fillColor: [1, 173, 232], textColor: [255, 255, 255] },
                styles: { fontSize: 9 }
            });

            yPoss = doc.lastAutoTable.finalY + 10;

            doc.setFontSize(11);
            doc.setFont("helvetica", "bold");
            doc.text("L'opticien", leftMargin + 140, yPoss + 20);
        }

        function drawRightAlignedText(doc, text, yPosition, marginRight = 10) {
            const pageWidth = doc.internal.pageSize.width; // Largeur de la page
            const textWidth = doc.getTextWidth(text); // Largeur du texte
            const xPosition = pageWidth - textWidth - marginRight; // Position X alignée à droite

            doc.text(text, xPosition, yPosition);
        }


        function addFooter() {
            // Add footer with current date and page number in X/Y format
            const pageCount = doc.internal.getNumberOfPages();
            const footerY = doc.internal.pageSize.getHeight() - 2; // 10 mm from the bottom

            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                doc.setFontSize(8);
                doc.setTextColor(0, 0, 0);
                const pageText = `Page ${i} sur ${pageCount}`;
                const pageTextWidth = doc.getTextWidth(pageText);
                const centerX = (doc.internal.pageSize.getWidth() - pageTextWidth) / 2;
                doc.text(pageText, centerX, footerY);
                doc.text("Imprimé le : " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString(), 15, footerY); // Left-aligned
            }
        }

        drawConsultationSection(yPos);

        addFooter();

        doc.output('dataurlnewwindow');

        // var blob = doc.output('blob');
        // var blobURL = URL.createObjectURL(blob);
        // window.open(blobURL);
    }

});