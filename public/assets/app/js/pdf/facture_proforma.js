$(document).ready(function () {

    window.PDF_Facture_Proforma = function (client, pres, produits, agence) 
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

        const pdfFilename = "Facture Proforma N° " + client[0];
        doc.setProperties({
            title: pdfFilename,
        });

        let yPos = 10;

        function drawConsultationSection(yPos) {
            rightMargin = 15;
            leftMargin = 15;
            pdfWidth = doc.internal.pageSize.getWidth();

            const titlea = "Proforma";
            doc.setFontSize(100);
            doc.setTextColor(242, 242, 242); // Gray color for background effect
            doc.setFont("Helvetica", "bold");
            doc.text(titlea, 130, yPos + 170, { align: 'center', angle: 40 });

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
            const address = "Siège social : Marcory Konankro face à l'école EPP TSF";
            const addressWidth = doc.getTextWidth(address);
            const addressX = (doc.internal.pageSize.getWidth() - addressWidth) / 2;
            doc.text(address, addressX, (yPos + 5));
            // Texte du téléphone
            const phone = "Email: joboptique@gmail.com - Compte Bancaire : 121383458001 ecobank";
            const phoneWidth = doc.getTextWidth(phone);
            const phoneX = (doc.internal.pageSize.getWidth() - phoneWidth) / 2;
            doc.text(phone, phoneX, (yPos + 9));

            const phone2 = "Tél.: +225 2720230558 / Cel.: +2250172972505";
            const phoneWidth2 = doc.getTextWidth(phone2);
            const phoneX2 = (doc.internal.pageSize.getWidth() - phoneWidth2) / 2;
            doc.text(phone2, phoneX2, (yPos + 13));

            const address2 = "27 BP 659 Abidjan 27 - RC No : CI-ABJ-2019-B-7745";
            const addressWidth2 = doc.getTextWidth(address2);
            const addressX2 = (doc.internal.pageSize.getWidth() - addressWidth2) / 2;
            doc.text(address2, addressX2, (yPos + 17));
            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");

            doc.setFontSize(30);
            doc.setLineWidth(0.3);
            doc.line(10, yPos + 20, 200, yPos + 20);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            const numDate = "FACTURE PROFORMA N° " + client[0];
            const numDateWidth = doc.getTextWidth(numDate);
            doc.text(numDate, (doc.internal.pageSize.getWidth() - numDateWidth) / 2, yPos + 30); 

            yPoss = yPos + 45;

            doc.setFontSize(12);
            doc.setFont("helvetica", "bold");
            doc.text("CLIENT", leftMargin + 20, yPoss);

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");
            doc.text("NOM", leftMargin + 5, yPoss + 10);
            doc.text(": " + client[1], leftMargin + 30, yPoss + 10);

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");
            doc.text("CONTACT", leftMargin + 5, yPoss + 15);
            doc.text(": +225 " + client[2], leftMargin + 30, yPoss + 15);

            doc.setFontSize(12);
            doc.setFont("helvetica", "bold");
            doc.text("AGENCE", leftMargin + 140, yPoss);

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");
            doc.text(agence, leftMargin + 130, yPoss + 10);

            yPoss = yPoss + 30;

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            const titre1 = "PRESCRIPTIONS";
            const titreWidth1 = doc.getTextWidth(titre1);
            const titreX1 = (doc.internal.pageSize.getWidth() - titreWidth1) / 2;
            doc.text(titre1, titreX1, (yPoss));
            
            // Tableau des prescriptions
            doc.autoTable({
                startY: yPoss + 3,
                head: [["", "SPHERE", "CYLINDRE", "AXE (°)", "ADDITION"]],
                body: [
                    ["OEIL DROIT", pres[0], pres[1], pres[2], pres[3]],
                    ["OEIL GAUCHE", pres[4], pres[5], pres[6], pres[7]]
                ],
                theme: "grid",
                headStyles: { fillColor: [135, 206, 235], textColor: [255, 255, 255] },
                styles: { fontSize: 9 }
            });

            yPoss = doc.lastAutoTable.finalY + 10;

            const donneeProduits = produits;
            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            const titre2 = "PRODUITS";
            const titreWidth2 = doc.getTextWidth(titre2);
            const titreX2 = (doc.internal.pageSize.getWidth() - titreWidth2) / 2;
            doc.text(titre2, titreX2, (yPoss));

            doc.autoTable({
                startY: yPoss + 3,
                head: [["N°", "DESIGNATION", "PRIX UNITAIRE", "QUANTITE", "PRIX TOTAL"]],
                body: donneeProduits.map((item, index) => [
                    index + 1,
                    item.nom,
                    item.prix.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa",
                    item.qte,
                    item.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa",
                ]),
                theme: "grid",
                headStyles: { fillColor: [135, 206, 235], textColor: [255, 255, 255] },
                styles: { fontSize: 8 }
            });

            yPoss = doc.lastAutoTable.finalY + 10;

            // Totaux
            doc.setFontSize(9);
            doc.setFont("helvetica", "normal");
            doc.text("TOTAL", leftMargin + 100, yPoss);
            doc.text(": " + client[4].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa", leftMargin + 140, yPoss);

            yPoss += 6;
            doc.setFontSize(9);
            doc.setFont("helvetica", "normal");
            doc.text("REDUCTION", leftMargin + 100, yPoss);
            doc.text(": " + client[6] + "%", leftMargin + 140, yPoss);

            yPoss += 6;
            doc.setFontSize(10);
            doc.setFont("helvetica", "bold");
            doc.text("NET A PAYER", leftMargin + 100, yPoss);
            doc.text(": " + client[5].toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa", leftMargin + 140, yPoss);

            doc.setFontSize(11);
            doc.setFont("Helvetica", "normal");
            const an2 = "Fait à Abidjan le " + formatDate(client[3]);
            doc.text(an2, leftMargin, (yPoss + 15));

            doc.setFontSize(11);
            doc.setFont("Helvetica", "normal");
            const an3 = "Le commercial";
            doc.text(an3, leftMargin + 140, (yPoss + 15));

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
    }

});