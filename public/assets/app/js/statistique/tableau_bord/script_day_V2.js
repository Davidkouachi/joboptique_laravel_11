$(document).ready(function () { 

    stat_day();
    stat_nbre();
    stat_table();

    $("#btn_refresh_stat_day").on("click", stat_day);
    $("#btn_refresh_stat_nbre").on("click", stat_nbre);
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
            url: '/api/stat_day',
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
                    },
                    { 
                        title: 'Ventes', 
                        today: data.vente.today, 
                        last_week: data.vente.last_week,
                        color: 'text-white', 
                    },
                    { 
                        title: 'Nouveau Clients', 
                        today: data.client.today, 
                        last_week: data.client.last_week,
                        color: 'text-white' 
                    },
                    { 
                        title: 'Versements', 
                        today: data.versement.today, 
                        last_week: data.versement.last_week,
                        color: 'text-white', 
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
                        <div class="col-xxl-3 col-sm-6">
                            <div class="card ${changeBg}">
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
            <div class="col-12" id="div_nbre_message">
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
            url: '/api/stat_nbre/' + $('#id_agence').val(),
            method: 'GET',
            success: function(response) {
                const data = response.data;

                const stats = [
                    {  
                        title: 'Solde Caisse', 
                        count: (data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') ?? 0 ),
                        icon: 'wallet-fill',
                        color: 'teal', 
                    },
                    { 
                        title: 'Total Clients', 
                        count: data.client,
                        icon: 'user-group-fill',
                        color: 'warning', 
                    },
                    { 
                        title: 'Assurance Acceptées', 
                        count: data.assurance,
                        icon: 'building-fill',
                        color: 'azure', 
                    },
                    { 
                        title: 'Agence', 
                        count: data.agence,
                        icon: 'map-pin-fill',
                        color: 'danger', 
                    },
                ];

                contenuDiv.empty();

                stats.forEach(function(stat) {

                    const div = $(`
                        <div class="col-xxl-3 col-sm-6" >
                            <div class="card pricing text-center bg-${stat.color}" >
                                <div class="pricing-body">
                                    <ul class="nk-store-statistics">
                                        <li class="item">
                                            <em class="icon bg-${stat.color}-dim ni ni-${stat.icon}"></em>
                                            <div class="info">
                                                <div class="title text-white">${stat.title}</div>
                                                <div class="count text-white">${stat.count}</div>
                                            </div>
                                        </li>
                                    </ul>
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
            url: '/api/stat_table',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                contenuDiv.empty();

                const div1 = $(`
                    <div class="nk-tb-list mt-2" id="div_table2">
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
                                <span class="tb-lead">
                                    <a href="#" style="color: #FF4500;">${item.code}</a>
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-info">
                                        <em class="ni ni-user"></em>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">${item.client}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">${formatDate(item.date)}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">${item.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') ?? 0}<span> Fcfa</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-${item.regle == 1 ? 'success' : 'danger'}">
                                    ${item.regle == 1 ? 'Reglé' : 'Non-rglé'}
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


});