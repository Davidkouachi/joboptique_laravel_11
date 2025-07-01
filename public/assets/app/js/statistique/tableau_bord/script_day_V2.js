$(document).ready(function () { 

    stat_day();
    stat_nbre();
    graph_vente_proforma();
    his_op();
    graph_rapport_caisse();
    stat_table();

    $("#btn_refresh_stat_day").on("click", stat_day);
    $("#btn_refresh_stat_nbre").on("click", stat_nbre);
    $("#btn_refresh_stat_vente_proforma").on("click", graph_vente_proforma);
    $("#btn_refresh_stat_hisOp").on("click", his_op);
    $("#btn_refresh_stat_raport_vente").on("click", graph_rapport_caisse);
    $("#btn_refresh_stat_table").on("click", stat_table);

    function stat_day() {

        const contenuDiv = $('#div_day');

        contenuDiv.empty();

        const div0 = $(`
            <div class="col-12" id="div_day_message">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group justify-content-center align-items-center">
                                <div class="card-title d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-warning me-1" role="status"></div>
                                    <h6 class="title text-warning">
                                        Veuillez patienter s'il vous plaît ...
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        contenuDiv.append(div0);

        $.ajax({
            url: $('#url').attr('content') + '/api/stat_day',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                contenuDiv.empty();

                const stats = [
                    { 
                        title: 'Factures Proforma', 
                        today: data.proforma.today, 
                        last_week: data.proforma.last_week,
                        color: 'text-white',
                        backgroun: 'background: linear-gradient(to right, #333333, #666666);', 
                    },
                    { 
                        title: 'Ventes', 
                        today: data.vente.today, 
                        last_week: data.vente.last_week,
                        color: 'text-white',
                        backgroun: 'background: linear-gradient(to right, #333333, #666666);',
                    },
                    { 
                        title: 'Nouveau Clients', 
                        today: data.client.today, 
                        last_week: data.client.last_week,
                        color: 'text-white',
                        backgroun: 'background: linear-gradient(to right, #333333, #666666);', 
                    },
                    { 
                        title: 'Versements', 
                        today: data.versement.today, 
                        last_week: data.versement.last_week,
                        color: 'text-white',
                        backgroun: 'background: linear-gradient(to right, #333333, #666666);', 
                    },
                ];

                // Function to calculate percentage change
                function calculatePercentageChange(today, last_week) {
                    if (last_week === 0) {
                        return today > 0 ? 100 : 0; // If last week's count is 0, return 100% (if today is greater than 0)
                    }
                    return ((today - last_week) / last_week) * 100;
                }

                stats.forEach(function(stat) {
                    const percentageChange = calculatePercentageChange(stat.today, stat.last_week);
                    const changeClass = percentageChange >= 0 ? 'text-teal' : 'text-danger'; // Color based on positive or negative change
                    const changeIcon = percentageChange > 0 ? 'ni-arrow-long-up' : (percentageChange < 0 ? 'ni-arrow-long-down' : ''); // Icon for positive or negative change
                    const changeIcon0 = percentageChange > 0 ? 'up' : (percentageChange < 0 ? 'down' : ''); // Class for positive or negative change
                    const changeBg = 'bg-secondary';

                    // Conditionally check if the percentage change is 0, and hide the icon if true
                    const iconHTML = percentageChange !== 0 
                        ? `<em class="icon ni ${changeIcon} ${changeClass}"></em> <span class="${changeClass}">${percentageChange.toFixed(2)}%</span>` 
                        : `<span class="${changeClass}">${percentageChange.toFixed(2)}%</span>`; // If percentage is 0, just display the percentage without the icon

                    const div = $(`
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card" style="${stat.backgroun}" >
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-white">${stat.title}</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <h4 class="${stat.color}" >${stat.today}</h4>
                                            </div>
                                            <div class="info ${changeClass}">
                                                <span class="change ${changeIcon0} ${changeClass}">
                                                    ${iconHTML}
                                                </span>
                                                <span class="text-white" style="font-size:12px;" >vs. la semaine passée (${stat.last_week})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    contenuDiv.append(div);

                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    function stat_nbre()
    {
        const contenuDiv = $('#div_nbre');

        contenuDiv.empty();

        const div0 = $(`
            <div class="col" id="div_nbre_message">
                <div class="">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group justify-content-center align-items-center">
                                <div class="card-title d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-warning me-1" role="status"></div>
                                    <h6 class="title text-warning">
                                        Veuillez patienter s'il vous plaît ...
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        contenuDiv.append(div0);

        $.ajax({
            url: $('#url').attr('content') + '/api/stat_nbre/' + $('#id_agence').val(),
            method: 'GET',
            success: function(response) {
                const data = response.data;

                const stats = [
                    // {  
                    //     title: 'Solde Caisse', 
                    //     count: (data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') ?? 0 ) + ' Fcfa',
                    //     icon: 'wallet-fill',
                    //     color: '#006400',
                    //     backgroun: 'background: linear-gradient(to right, #32CD32, #006400);',
                    // },
                    { 
                        title: 'Total Clients', 
                        count: data.client,
                        icon: 'user-group-fill',
                        color: '#FF4500',
                        backgroun: 'background: linear-gradient(to right, #FFA500, #FF4500);', 
                    },
                    { 
                        title: 'Assurance Acceptées', 
                        count: data.assurance,
                        icon: 'building-fill',
                        color: '#00008B',
                        backgroun: 'background: linear-gradient(to right, #1E90FF, #00008B);',
                    },
                    { 
                        title: 'Agences', 
                        count: data.agence,
                        icon: 'map-pin-fill',
                        color: '#B22222',
                        backgroun: 'background: linear-gradient(to right, #FF6347, #B22222);',
                    },
                    { 
                        title: 'Services', 
                        count: data.service,
                        icon: 'tree-structure-fill',
                        color: '#6A0DAD',
                        backgroun: 'background: linear-gradient(to right, #9370DB, #6A0DAD);',
                    },
                    { 
                        title: 'Utilisateurs', 
                        count: data.users,
                        icon: 'user',
                        color: '#8B4513',
                        backgroun: 'background: linear-gradient(to right, #CD853F, #8B4513);',
                    },
                ];

                contenuDiv.slick('unslick');
                contenuDiv.empty();

                stats.forEach(function(stat) {

                    const div = $(`
                        <div class="col" >
                            <div class="card pricing text-center" style="${stat.backgroun}" >
                                <div class="pricing-body">
                                    <ul class="nk-store-statistics">
                                        <li class="item">
                                            <em style="color:${stat.color};" class="icon bg-white ni ni-${stat.icon}"></em>
                                            <div class="info">
                                                <div class="title text-white">${stat.title}</div>
                                                <div style="font-size:14px;" class="count text-white">${stat.count}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `);

                    contenuDiv.append(div);
                });

                // 3. Réinitialiser le slider avec les mêmes options
                contenuDiv.slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    accessibility: true,
                    responsive: [
                        { breakpoint: 1500, settings: { slidesToShow: 3} },
                        { breakpoint: 892, settings: { slidesToShow: 2} },
                        { breakpoint: 582, settings:{ slidesToShow: 1} },
                    ]
                });

                // Initial styling
                styliserSlickArrows();

                // Réappliquer à chaque redimensionnement ou changement
                $('#div_nbre').on('setPosition afterChange reInit', function () {
                    styliserSlickArrows();
                });
                
                function styliserSlickArrows() {
                    $('.slick-prev, .slick-next').css({
                        display: 'flex',
                        visibility: 'visible',
                        opacity: 1,
                        zIndex: 1000,
                        position: 'absolute',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        backgroundColor: 'white',
                        borderRadius: '50%',
                        width: '40px',
                        height: '40px',
                        fontSize: '18px',
                        color: '#00008B',
                        border: '1px solid #ccc',
                        boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
                        alignItems: 'center',
                        justifyContent: 'center',
                        cursor: 'pointer'
                    });

                    $('.slick-prev').css({ left: '-5px' }).html('<em class="ni ni-chevron-left"></em>');
                    $('.slick-next').css({ right: '-5px' }).html('<em class="ni ni-chevron-right"></em>');
                }

            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    function stat_table()
    {
        const contenuDiv = $('#div_table');

        contenuDiv.empty();

        const div0 = $(`
            <div class="card-inner mb-3" >
                <div class="card-title-group justify-content-center align-items-center">
                    <div class="card-title d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-warning me-1" role="status"></div>
                        <h6 class="title text-warning">
                            Veuillez patienter s'il vous plaît ...
                        </h6>
                    </div>
                </div>
            </div>
        `);

        contenuDiv.append(div0);

        $.ajax({
            url: $('#url').attr('content') + '/api/stat_table/' + $('#id_agence').val(),
            method: 'GET',
            success: function(response) {
                const data = response.data;

                contenuDiv.empty();

                const div1 = $(`
                    <div class="nk-tb-list mt-2" id="div_table2" >
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Code vente</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Client</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Montant Total</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Statut</span></div>
                        </div>
                    </div>
                `);

                contenuDiv.append(div1);

                data.forEach(function(item) {

                    const div = $(`
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-orange">
                                        <em class="ni ni-file"></em>
                                    </div>
                                    <div class="user-name">
                                        <span style="color: orange;" class="tb-lead">${item.code}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">${item.client}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">${formatDate(item.date)}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">${item.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') ?? '0'}<span> Fcfa</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-${item.regle == '1' ? 'success' : 'danger'}">
                                    ${item.regle == '1' ? 'Reglé' : 'Non-rglé'}
                                </span>
                            </div>
                        </div>
                    `);

                    $('#div_table2').append(div);
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }

    function his_op()
    {
        const contenuDiv = $('#div_his_op');

        contenuDiv.empty();

        const div0 = `
            <div class="card-inner mb-3" >
                <div class="card-title-group justify-content-center align-items-center">
                    <div class="card-title d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-warning me-1" role="status"></div>
                        <h6 class="title text-warning">
                            Veuillez patienter s'il vous plaît ...
                        </h6>
                    </div>
                </div>
            </div>
        `;

        contenuDiv.append(div0);

        const today = new Date();

        // Obtenir le numéro du jour dans la semaine (0 = dimanche, 1 = lundi, ..., 6 = samedi)
        const dayOfWeek = today.getDay();

        // Calculer la date du lundi (début de semaine)
        const monday = new Date(today);
        monday.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));

        // Calculer la date du dimanche (fin de semaine)
        const sunday = new Date(monday);
        sunday.setDate(monday.getDate() + 6);

        // Fonction pour formater en yyyy-mm-dd
        function formatDateSemaine(date) {
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        // Générer les dates
        let date1 = formatDateSemaine(monday);   // Lundi
        let date2 = formatDateSemaine(sunday);   // Dimanche

        const magasin = $('#agence_id').val();

        $.ajax({
            url: $('#url').attr('content') + '/api/list_operation_all/'+date1+'/'+date2+'/'+magasin,
            method: 'GET',
            success: function(response) {
                const operation = response.data;

                contenuDiv.empty();

                if (operation.length > 0) {

                    const div1 = `
                        <ul class="timeline-list" id="div_his_op_contenu"></ul>
                    `;

                    contenuDiv.append(div1);

                    $.each(operation, function(index, item) {

                        const row = `
                            <li class="timeline-item">
                                <div class="timeline-status bg-azure"></div>
                                <div class="timeline-date">
                                    ${getRelativeDateLabel(item.created_at)}
                                </div>
                                <div class="timeline-data">
                                    <h6 class="timeline-title">
                                        ${item.libelle}
                                    </h6>
                                    <div class="timeline-des d-flex flex-column gap-2">
                                        <span class="time d-flex gap-1 justify-content-start align-items-center">
                                            <span class="badge ${item.type === 'sortie' ? 'bg-danger' : (item.type === 'entree' ? 'bg-success' : (item.type_operation === '4' || item.type_operation === '5'   ? 'bg-warning' : 'bg-secondary'))}">
                                            ${(item.type === 'sortie' ? '-' : (item.type === 'entree' ? '+' : ''))} 
                                            ${item.montant ? item.montant.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'} Fcfa
                                        </span>
                                            <em class="icon ni ni-alarm-alt"></em>
                                            ${formatDateHeure(item.created_at)}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        `;

                        $("#div_his_op_contenu").append(row);
                    });

                } else {
                    
                    const message = `
                        <h6 class="timeline-head text-danger">Aucune données n'a été trouver ...</h6>
                    `;

                    contenuDiv.append(message);
                }

            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');

                const message = $(`
                    <h6 class="timeline-head text-danger">Aucune données n'a été trouver ...</h6>
                `);

                contenuDiv.append(message);
            }
        });
    }

    function graph_vente_proforma() 
    {

        const contenug = $("#graph_vente_proforma");

        contenug.empty();

        const preloader = `
            <div class="card-title-group justify-content-center align-items-center" id="div_vente_prevision_message1">
                <div class="card-title d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-1" role="status"></div>
                    <h6 class="title text-warning">
                        Veuillez patienter s'il vous plaît ...
                    </h6>
                </div>
            </div>
        `;

        contenug.append(preloader);

        const magasin = $('#agence_id').val();

        fetch( $('#url').attr('content') + '/api/stat_vente_proforma/' + magasin)
            .then(response => response.json())
            .then(data => {
                
                contenug.empty();

                const months = [
                    "Janv", "Fév", "Mar", "Avr", "Mai", "Jui", 
                    "Juil", "Août", "Sept", "Oct", "Nov", "Déc"
                ];

                // Initialisation des tableaux pour 12 mois
                const total_vente = new Array(12).fill(0);
                const nombre_vente = new Array(12).fill(0);
                const nombre_proforma = new Array(12).fill(0);

                const currentYearVente = new Array(12).fill(0);
                const currentYearNombreVente = new Array(12).fill(0);
                const currentYearNombreProforma = new Array(12).fill(0);

                // Remplissage des données
                data.prevision.forEach(item => {
                    const monthIndex = item.month - 1;
                    total_vente[monthIndex] = item.total_vente;
                    nombre_vente[monthIndex] = item.nombre_vente;
                    nombre_proforma[monthIndex] = item.nombre_proforma;
                });

                var options = {
                    chart: {
                        height: 350,
                        type: "line",
                        stacked: false,
                        toolbar: { show: false },
                        zoom: { enabled: false }
                    },
                    dataLabels: { enabled: false },
                    stroke: {
                        width: [2, 0], // Ligne pour les ventes, colonne pour le nombre
                        curve: "smooth"
                    },
                    series: [
                        {
                            name: "Montant des Ventes (Fcfa)",
                            type: "line",
                            data: total_vente,
                            yaxisIndex: 0 // Associé à l'axe Y gauche (prix)
                        },
                        {
                            name: "Nombre de Ventes",
                            type: "column",
                            data: nombre_vente,
                            yaxisIndex: 1 // Associé à l'axe Y droit (nombre de ventes)
                        },
                        {
                            name: "Nombre de Proformas",
                            type: "column",
                            data: nombre_proforma,
                            yaxisIndex: 2 // Associé à l'axe Y droit (nombre de ventes)
                        }
                    ],
                    xaxis: {
                        categories: months,
                        labels: { 
                            style: { colors: "#000" }, // Texte en noir
                        }
                    },
                    yaxis: [
                        {
                            labels: {
                                formatter: function(val) {
                                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa";
                                },
                                style: { colors: "#006400" } // Vert pour les prix
                            }
                        },
                        {
                            opposite: true,
                            labels: {
                                style: { colors: "#00000" } // Bleu pour les ventes
                            }
                        }
                    ],
                    colors: ["#006400", "#FF4500", "#00008B"], // Vert pour le prix, Bleu pour les ventes
                    markers: {
                        size: 4,
                        colors: ["#006400", "#FF4500", "#00008B"],
                        strokeColor: "#ffffff",
                        strokeWidth: 2
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            }
                        }
                    }
                };

                const divcon = $(`
                    <div class="" id="contenu_graph_vente_proforma" ></div>
                `);

                contenug.append(divcon);

                var chart = new ApexCharts(document.querySelector("#contenu_graph_vente_proforma"), options);
                chart.render();

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);
            });
    }

    function graph_rapport_caisse() 
    {

        const contenug = $("#graph_rapport_caisse");

        contenug.empty();

        const preloader = `
            <div class="card-title-group justify-content-center align-items-center" id="div_vente_prevision_message1">
                <div class="card-title d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-warning me-1" role="status"></div>
                    <h6 class="title text-warning">
                        Veuillez patienter s'il vous plaît ...
                    </h6>
                </div>
            </div>
        `;

        contenug.append(preloader);

        const magasin = $('#agence_id').val();

        fetch( $('#url').attr('content') + '/api/stat_rapport_caisse/' + magasin)
            .then(response => response.json())
            .then(data => {
                
                contenug.empty();

                const totalEntrer = data.total_entrer;
                const totalSortie = data.total_sortie;

                var options = {
                    chart: {
                        type: 'donut',
                        height: 300
                    },
                    labels: ['Entrées (+)', 'Sorties (-)'],
                    series: [totalEntrer, totalSortie],
                    colors: ["#0ebb13", "#ff5a39"],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '14px',
                                        fontWeight: 600,
                                        color: '#333',
                                        offsetY: -10
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '16px',
                                        fontWeight: 'bold',
                                        color: '#000',
                                        formatter: function (val) {
                                            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa";
                                        },
                                        offsetY: 10
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        fontSize: '16px',
                                        fontWeight: 600,
                                        color: '#436ccf',
                                        formatter: function (w) {
                                            let sum = w.globals.seriesTotals.reduce((a, b) => a - b);
                                            return sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa";
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opts) {
                            // return opts.w.config.labels[opts.seriesIndex] + ": " + val.toFixed(1) + "%";
                            return val.toFixed(1) + "%";
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '14px',
                        labels: {
                            colors: '#444'
                        }
                    },
                    tooltip: {
                        custom: function({ series, seriesIndex, w }) {
                            const label = w.config.labels[seriesIndex];
                            const value = series[seriesIndex];
                            const formatted = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            const signe = label === 'Sorties' ? '- ' : '+ ';
                            return `<div style="padding: 5px;">
                                        <strong>${label}</strong>: ${signe}${formatted} Fcfa
                                    </div>`;
                        }
                    }
                };



                const divcon = $(`
                    <div class="" id="contenu_graph_rapport_caisse" ></div>
                `);

                contenug.append(divcon);

                var chart = new ApexCharts(document.querySelector("#contenu_graph_rapport_caisse"), options);
                chart.render();

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);
            });
    }










    function getRelativeDateLabel(dateString) {
        const date = new Date(dateString);
        const today = new Date();

        // Réinitialiser à minuit pour comparer les jours uniquement
        const oneDay = 24 * 60 * 60 * 1000;
        const dateOnly = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        const todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());

        const diffDays = Math.round((todayOnly - dateOnly) / oneDay);

        if (diffDays === 0) {
            return "Aujourd'hui";
        } else if (diffDays === 1) {
            return "Hier";
        } else {
            return `Il y a ${diffDays} jours`;
        }
    }


});