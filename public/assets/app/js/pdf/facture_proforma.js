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

            doc.setFontSize(8);
            doc.setFont("helvetica", "normal");
            doc.text("NOM", leftMargin + 5, yPoss + 10);
            doc.text(": " + client[1], leftMargin + 30, yPoss + 10);

            doc.setFontSize(8);
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
                headStyles: { fillColor: [1, 173, 232], textColor: [255, 255, 255] },
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
                headStyles: { fillColor: [242, 147, 37], textColor: [255, 255, 255] },
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
            doc.text(an2, leftMargin, (yPoss + 50));

            doc.setFontSize(11);
            doc.setFont("Helvetica", "normal");
            const an3 = "Le commercial";
            doc.text(an3, leftMargin + 140, (yPoss + 50));

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

window.PDF_Assurance = async function () {
    const { jsPDF } = window.jspdf;

    const doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });

    const pdfFilename = "Statistiques des consommations";
    doc.setProperties({ title: pdfFilename });

    let yPoss = 0;
    let yPos = 30;

    let mLeft = 10;

    const color1 = "#280ea0"; // Bleu
    const color2 = "#fb0005"; // Rouge

    const W = doc.internal.pageSize.getWidth();
    const H = doc.internal.pageSize.getHeight();

    // --- Convertir une image en Promise qui se résout quand elle est chargée
    function loadImage(src) {
        return new Promise((resolve) => {
            const img = new Image();
            img.src = src;
            img.onload = () => resolve(img);
        });
    }

    function titreLabel(label, color, y) {
        // === Bandeau titre style "orange à gauche, arrondi à droite" ===
        const title = label;
        doc.setFont("helvetica", "bold");
        doc.setFontSize(12);

        // Padding autour du texte
        const paddingX = 6;
        const paddingY = 3;

        // Largeur du texte
        const textWidth = doc.getTextWidth(title);
        const boxW = textWidth + 5 + paddingX * 2;
        const boxH = 8;
        const boxX = 0; // démarre complètement à gauche du PDF
        const boxY = y; 
        const radius = boxH / 2;

        // Bande rectangulaire (de x=0 jusqu’avant l’arrondi)
        doc.setFillColor(color); // orange (#F7931E)
        doc.roundedRect(boxX - 10, boxY - boxH + 2, boxW + mLeft, boxH, 5, 5, "F");

        // Texte en blanc par-dessus
        doc.setTextColor(255, 255, 255);
        doc.text(title, boxX + mLeft, boxY);
    }

    function drawRightRoundedBox(doc, x, y, w, h, r, color) {
        doc.setFillColor(color[0], color[1], color[2]);

        doc.setDrawColor(color[0], color[1], color[2]); 
        doc.setLineWidth(0);

        doc.lines(
            [
                [w - r, 0],         // ligne horizontale en haut
                [r, r],             // quart de cercle haut droit
                [0, h - 2*r],       // ligne verticale
                [-r, r],            // quart de cercle bas droit
                [-(w - r), 0],      // ligne horizontale bas
            ],
            x, y,
            [1, 1],
            "F"
        );
    }

    function addTableWithFooterCheck(doc, columns, body, startY, color1) {
        const footerHeight = 15;     // hauteur du footer (ligne + logo + texte)
        const minBottomMargin = 0;  // marge de sécurité au-dessus du footer

        const tableWidth = doc.internal.pageSize.getWidth() - 20; // largeur utile
        const colCount = columns.length;
        const colWidth = tableWidth / colCount;

        const columnStyles = {};
        for (let i = 0; i < colCount; i++) {
            columnStyles[i] = { cellWidth: colWidth };
        }

        // === Vérifie si la zone restante est suffisante pour le tableau ===
        if (startY + 40 > H - (footerHeight + minBottomMargin)) {
            doc.addPage();
            startY = 40; // recommencer plus haut
            console.log(`Nouvelle page forcée → startY = ${startY}`);
        }

        // === Création du tableau ===
        doc.autoTable({
            startY: startY,
            head: [columns],
            body: body,
            theme: "grid",
            tableWidth: tableWidth,
            margin: { left: 10, right: 10, top: 20, bottom: 18 }, // ✅ bottom = padding
            headStyles: {
                fillColor: color1,
                textColor: [255, 255, 255],
                halign: "center"
            },
            styles: {
                fontSize: 7,
                cellPadding: 2,
                halign: "center",
                valign: "middle"
            },
            // columnStyles: columnStyles,
            // Largeurs de colonnes
            columnStyles: {
                0: { cellWidth: 10 }, // ✅ colonne index fixe à 20px
            },
            didDrawPage: (data) => {
                // position finale du tableau (après rendu)
                const cursorY = data.cursor.y;
                console.log(
                    `Page ${doc.internal.getCurrentPageInfo().pageNumber} → startY = ${startY} | cursorY = ${cursorY}`
                );

                // si le tableau est descendu trop bas → forcer nouvelle page
                if (cursorY + minBottomMargin > H - footerHeight) {
                    doc.addPage();
                    startY = 40;
                    console.log(
                        `⚠️ Tableau proche du footer → on ajoute une nouvelle page, startY = ${startY}`
                    );
                }
            }
        });

        return startY;
    }

    async function drawConsultationSection(yPos) {
        let leftMargin = 0;

        // === 1) Image d'en-tête ===
        const logoSrc = "assets/images/test/design.png";
        const logoWidth = 380;
        const logoHeight = 230;
        const hero = await loadImage(logoSrc);
        doc.addImage(hero, "PNG", leftMargin - 100, yPoss - 70, logoWidth, logoHeight);

        // === 2) Gros titre ===
        doc.setFont("helvetica", "bold");
        doc.setFontSize(28);
        doc.setTextColor(color1);

        const mainTitle = "ASSURANCE MALADIE";
        const mainWidth = 150;

        const textWidthT = doc.getTextWidth(mainTitle);
        const extraSpaceT = mainWidth - textWidthT;
        const charSpacing = extraSpaceT / (mainTitle.length - 1);

        let spacedTextT = "";
        for (let i = 0; i < mainTitle.length; i++) {
            spacedTextT += mainTitle[i];
            if (i < mainTitle.length - 1) {
                spacedTextT += " ".repeat(
                    Math.max(1, Math.round(charSpacing / doc.getTextWidth(" ")))
                );
            }
        }

        doc.text(spacedTextT, W / 2, yPos + 150, { align: "center" });

        // === Sous-titre ===
        drawSpacedText(
            doc,
            "STATISTIQUES DE CONSOMMATION",
            W / 2,
            yPos + 157,
            mainWidth,
            { font: "helvetica", style: "normal", size: 13, color: [40, 14, 160] }
        );

        function drawSpacedText(doc, text, xCenter, y, targetWidth, options = {}) {
            const {
                font = "helvetica",
                style = "normal",
                size = 18,
                color = [0, 0, 0],
            } = options;

            doc.setFont(font, style);
            doc.setFontSize(size);
            doc.setTextColor(...color);

            const textWidth = doc.getTextWidth(text);
            let extraSpace = 0;
            if (text.length > 1) {
                extraSpace = (targetWidth - textWidth) / text.length;
            }

            const startX = xCenter - targetWidth / 2;
            let cursorX = startX;
            for (let i = 0; i < text.length; i++) {
                const char = text[i];
                doc.text(char, cursorX, y);
                cursorX += doc.getTextWidth(char) + extraSpace;
            }
        }

        // === 4) Bandeau bleu ===
        const pillText = "01 JUILLET 2024 AU 31 DECEMBRE 2024";
        doc.setFont("helvetica", "bold");
        doc.setFontSize(11);

        const textWidth = doc.getTextWidth(pillText);
        const extraSpace = (mainWidth - textWidth) / (pillText.length - 1);

        let spacedText = "";
        for (let i = 0; i < pillText.length; i++) {
            spacedText += pillText[i];
            if (i < pillText.length - 1) {
                spacedText += " ".repeat(
                    Math.max(1, Math.round(extraSpace / 2))
                );
            }
        }

        const pillW = mainWidth + 16;
        const pillH = 10;
        const pillX = (W - pillW) / 2;
        const pillY = yPos + 164;
        const r = pillH / 3;

        doc.setFillColor(color1);
        doc.roundedRect(pillX, pillY - pillH / 2, pillW, pillH, r, r, "F");

        doc.setTextColor(255, 255, 255);
        doc.text(spacedText, W / 2, pillY, {
            align: "center",
            baseline: "middle",
        });

        // === 5) Référence ===
        doc.setFont("helvetica", "bold");
        doc.setFontSize(25);
        doc.setTextColor(color2);
        doc.text("MA - IDT", W / 2, pillY + 35, { align: "center" });

        doc.setDrawColor(color2);
        doc.setLineWidth(0.6);
        doc.line(W / 2 - 25, pillY + 38, W / 2 + 25, pillY + 38);

        // === 6) Logo du bas ===
        const footerLogo = "assets/images/test/logo.png";
        const logoW = 50;
        const logoH = 25;
        const footer = await loadImage(footerLogo);
        doc.addImage(footer, "PNG", W / 2 - 25, pillY + 55, logoW, logoH);
    }

    async function drawPage2(yPos) {
        let y = yPos - 10;

        await titreLabel("SINISTRALITÉ GLOBALE 1", color2, y);

        // === Données ===
        const labels = ["Prime nette (P)", "Frais médicaux (S)", "Indemnités", "Cotisations", "Autres"];

        // Données du premier donut
        const values1 = [40, 25, 15, 10, 10];
        // Données du deuxième donut
        const values2 = [30, 20, 25, 15, 10];

        // === Donuts côte à côte ===
        const data = [
            {
                type: "pie",
                hole: 0.7,
                values: values1,
                labels: labels,
                name: "Donut 1",
                domain: { row: 0, column: 0 },  // ✅ position (gauche)
                textinfo: "percent",
                textposition: "inside",
                insidetextfont: { color: "#fff", size: 12 },
                marker: {
                    colors: ["#005EB8", "#F7931E", "#2CA02C", "#D62728", "#9467BD"],
                    line: { color: "#fff", width: 1 }
                }
            },
            {
                type: "pie",
                hole: 0.7,
                values: values2,
                labels: labels,
                name: "Donut 2",
                domain: { row: 0, column: 1 },  // ✅ position (droite)
                textinfo: "percent",
                textposition: "inside",
                insidetextfont: { color: "#fff", size: 12 },
                marker: {
                    colors: ["#005EB8", "#F7931E", "#2CA02C", "#D62728", "#9467BD"],
                    line: { color: "#fff", width: 1 }
                }
            }
        ];

        // === Mise en page ===
        const total = values1.reduce((a, b) => a + b, 0) + values2.reduce((a, b) => a + b, 0);

        const layout = {
            grid: { rows: 1, columns: 2 }, // ✅ deux colonnes
            paper_bgcolor: "rgba(0,0,0,0)", // fond global transparent
            plot_bgcolor: "rgba(0,0,0,0)",  // zone de tracé transparente
            autosize: true,
            margin: { l: 20, r: 20, t: 40, b: 60 }, // marges réduites
            // title: {
            //     text: "Répartition",
            //     font: { size: 16 },
            //     x: 0.5,               // centré horizontalement
            //     xanchor: "center"
            // },
            showlegend: true,
            legend: {
                orientation: "h",     // légende horizontale
                x: 0.5,               // centré horizontalement
                xanchor: "center",
                y: -0.2,              // placée sous le graphique
                font: {
                    family: "Arial",  // police
                    size: 14,         // ✅ taille de la légende
                    color: "#000"     // ✅ couleur du texte
                }
            },
            // annotations: [
            //     {
            //         text: `TOTAL<br>${total}`, // Texte au centre
            //         x: 0.5,
            //         y: 0.5,
            //         font: { size: 14, color: "#000", family: "Arial", weight: "bold" },
            //         showarrow: false
            //     }
            // ],
            annotations: [
                {
                    text: "Donut 1<br>Total: " + values1.reduce((a, b) => a + b, 0),
                    x: 0.19,   // ✅ centre du donut gauche
                    y: 0.5,
                    showarrow: false,
                    font: { size: 14, color: "#000", family: "Arial", weight: "bold" }
                },
                {
                    text: "Donut 2<br>Total: " + values2.reduce((a, b) => a + b, 0),
                    x: 0.81,   // ✅ centre du donut droit
                    y: 0.5,
                    showarrow: false,
                    font: { size: 14, color: "#000", family: "Arial", weight: "bold" }
                }
            ],
        };

        // Ajout dans le PDF
        await addPlotlyToPDF(doc, data, layout, null, 20, 190, 80);

        await titreLabel("SINISTRALITÉ GLOBALE 2", color2, y + 90);

        // === Exemple tableau 7 colonnes ===
        const columns = ["N°","Col 1", "Col 2", "Col 3"];
        // === Données (100 lignes aléatoires) ===
        const body = [];
        for (let i = 0; i < 30; i++) {
            body.push([
                `${i + 1}`,
                `Ligne ${i + 1}-1`,
                `Ligne ${i + 1}-2`,
                `Ligne ${i + 1}-3`,
            ]);
        }

        // === Position de départ du tableau ===
        let startY = y + 100;
        // === Appel de la fonction ===
        startY = await addTableWithFooterCheck(doc, columns, body, startY, color1);
        // === Footer sur toutes les pages (après avoir ajouté le tableau) ===
        const totalPages = doc.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
            doc.setPage(i);
            await addFooter(i, totalPages, W, H); // ← ta fonction footer
        }
    }

    async function drawPage3(yPos) {
        let y = yPos - 10;

        await titreLabel("SINISTRALITÉ GLOBALE 3", color2, y);

    }

    async function addPlotlyToPDF(doc, data, layout, x, y, w, h) {
        const scale = 4; // upscale pour meilleure qualité

        // Création du conteneur hors écran
        const div = document.createElement("div");
        div.style.width = w * scale + "px";
        div.style.height = h * scale + "px";
        div.style.position = "absolute";
        div.style.left = "-9999px";
        div.style.background = "transparent"; // ✅ fond transparent
        document.body.appendChild(div);

        try {
            // Génération du graphique Plotly
            await Plotly.newPlot(div, data, layout);

            // Export en image haute résolution
            const imgData = await Plotly.toImage(div, {
                format: "png",
                width: w * scale,
                height: h * scale,
                scale: scale
            });

            // === Centrage automatique ===
            const pageWidth = doc.internal.pageSize.getWidth();
            const centerX = (pageWidth - w) / 2;

            // Ajout au PDF
            doc.addImage(imgData, "PNG", centerX, y, w, h);
        } finally {
            // Nettoyage
            document.body.removeChild(div);
        }
    }

    async function addFooter(pageNumber, totalPages, pageWidth, pageHeight) {
        if (pageNumber < 2) return; // à partir de la page 2

        const footerHeight = 15; 
        const y = pageHeight - footerHeight;

        // Ligne horizontale bleue
        doc.setDrawColor(color1); // bleu
        doc.setLineWidth(1);
        doc.line(10, y, pageWidth - 10, y);

        // === Logo à gauche ===
        // Remplace "logoBase64" par ton image en base64 (PNG ou JPG)
        const logoSrcF = "assets/images/test/logo.png";
        const logoWidth = 27;
        const logoHeight = 10;
        const heroF = await loadImage(logoSrcF);
        doc.addImage(heroF, "PNG", mLeft, y + 2, logoWidth, logoHeight);

        // // === Texte centré ===
        doc.setFont("helvetica", "bold");
        doc.setFontSize(8);
        doc.setTextColor(color1); // bleu foncé
        doc.text(
            "ASSURANCE MALADIE • STATISTIQUES DE CONSOMMATION • MA-IDT",
            mLeft + 30,
            y + 9,
        );

        // // === Cercle numéro de page à droite ===
        const circleRadius = 5;
        const circleX = pageWidth - 15;
        const circleY = y + 8;

        doc.setFillColor(color1);
        doc.circle(circleX, circleY, circleRadius, "F");

        // // Numéro de page (blanc, centré dans le cercle)
        doc.setTextColor(255, 255, 255);
        doc.setFontSize(14);
        doc.setFont("helvetica", "bold");
        doc.text(`${pageNumber}`, circleX, circleY + 2, { align: "center" });
    }

    // === page de couverture ===
    await drawConsultationSection(yPos);

    // === Nouvelle page ===
    doc.addPage(); 

    await drawPage2(yPos);

    // === Nouvelle page ===
    doc.addPage(); 

    await drawPage3(yPos);

    const P = doc.internal.getNumberOfPages();

    for (let i = 1; i <= P; i++) {
        doc.setPage(i);
        await addFooter(i, P, W, H);
    }

    // === Sauvegarde ===
    // doc.save("Couverture.pdf");
    // doc.output('dataurlnewwindow');

    const pdfData = doc.output("bloburl");
    window.open(pdfData);

};


});