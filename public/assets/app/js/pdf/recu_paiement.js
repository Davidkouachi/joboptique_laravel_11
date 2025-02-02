$(document).ready(function () {

    window.PDF_Recu_Paiement = function (facture, recu) 
    {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

        const pdfFilename = "RECU PAIEMENT N° VS-" + recu.id ;
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
            doc.line(10, yPos + 16, 200, yPos + 16);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "bold");
            doc.setTextColor(0, 0, 0);
            const numDate = "RECU DE VERSEMENT N° VS-" + recu.id;
            const numDateWidth = doc.getTextWidth(numDate);
            doc.text(numDate, (doc.internal.pageSize.getWidth() - numDateWidth) / 2, yPos + 23);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            doc.setTextColor(0, 0, 0);
            doc.text("Abidjan le " + new Date().toLocaleDateString(), leftMargin , yPos + 23);

            yPoss = yPos + 25;

            const clientData = [
                ["Nom & Prénoms du Client", facture.client],
                ["Motif du Versement", "ACHAT N° "+facture.code],
                ["Part Assurance", facture.partassurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa"],
                ["Somme Verser", recu.montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa"],
                ["Date Livraison", formatDate(facture.date_retrait)],  
            ];

            doc.setFontSize(10);

            clientData.forEach((item, index) => {
                doc.setFont("times", "normal");
                doc.text(item[0], leftMargin , yPoss + (index * 5) + 8);

                doc.setFont("times", "bold");
                doc.text(": " + item[1], leftMargin + 40, yPoss + (index * 5) + 8);
            });

            const clientData2 = [
                ["Contact", facture.contact],
                ["Net à Payer", facture.partclient.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa"],
                ["Montant Verser", recu.montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa"],
                ["Reste à Verser", facture.reste.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa"],
                ["Date Versement", formatDate(recu.date)],  
            ];

            doc.setFontSize(10);

            clientData2.forEach((item, index) => {
                doc.setFont("times", "normal");
                doc.text(item[0], leftMargin + 130, yPoss + (index * 5) + 8);

                doc.setFont("times", "bold");
                doc.text(": " + item[1], leftMargin + 155, yPoss + (index * 5) + 8);
            });

            let yOffsetAfterTotal = yPoss + (clientData2.length * 6);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            const an2 = "Commercial :";
            doc.text(an2, leftMargin, yOffsetAfterTotal + 10);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            const an3 = "Visa du Client";
            doc.text(an3, leftMargin + 70, yOffsetAfterTotal + 10);

            doc.setFontSize(10);
            doc.setFont("Helvetica", "normal");
            const an4 = "Visa de la Caissière :";
            doc.text(an4, leftMargin + 140, yOffsetAfterTotal + 10);

            doc.setFontSize(30);
            doc.setLineWidth(0.3);
            doc.setLineDash([1, 1], 0);
            doc.line(10, yPos + 85, 200, yPos + 85);
            doc.setLineDash([]);
        }

        // function addFooter() {
        //     // Add footer with current date and page number in X/Y format
        //     const pageCount = doc.internal.getNumberOfPages();
        //     const footerY = doc.internal.pageSize.getHeight() - 2; // 10 mm from the bottom

        //     for (let i = 1; i <= pageCount; i++) {
        //         doc.setPage(i);
        //         doc.setFontSize(8);
        //         doc.setTextColor(0, 0, 0);
        //         const pageText = `Page ${i} sur ${pageCount}`;
        //         const pageTextWidth = doc.getTextWidth(pageText);
        //         const centerX = (doc.internal.pageSize.getWidth() - pageTextWidth) / 2;
        //         doc.text(pageText, centerX, footerY);
        //         doc.text("Imprimé le : " + new Date().toLocaleDateString() + " à " + new Date().toLocaleTimeString(), 15, footerY); // Left-aligned
        //     }
        // }

        drawConsultationSection(yPos);
        drawConsultationSection(yPos + 95);
        drawConsultationSection(yPos + 190);

        // addFooter();

        doc.output('dataurlnewwindow');
    }

});