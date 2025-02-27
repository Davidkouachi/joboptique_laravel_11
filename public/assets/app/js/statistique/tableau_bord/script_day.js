$(document).ready(function () { 

    stat_day();
    stat_nbre();
    stat_table();

    function stat_day() {
        $('#div_day_message').show();

        $.ajax({
            url: '/api/stat_day',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                const contenuDiv = $('#div_day');

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

                $('#div_day_message').hide();

                // Function to calculate percentage change
                function calculatePercentageChange(today, last_week) {
                    if (last_week === 0) {
                        return today > 0 ? 100 : 0; // If last week's count is 0, return 100% (if today is greater than 0)
                    }
                    return ((today - last_week) / last_week) * 100;
                }

                stats.forEach(function(stat) {
                    const percentageChange = calculatePercentageChange(stat.today, stat.last_week);
                    const changeClass = percentageChange >= 0 ? 'text-white' : 'text-white'; // Color based on positive or negative change
                    const changeIcon = percentageChange > 0 ? 'ni-arrow-long-up' : (percentageChange < 0 ? 'ni-arrow-long-down' : ''); // Icon for positive or negative change
                    const changeIcon0 = percentageChange > 0 ? 'up' : (percentageChange < 0 ? 'down' : ''); // Class for positive or negative change

                    // Conditionally check if the percentage change is 0, and hide the icon if true
                    const iconHTML = percentageChange !== 0 
                        ? `<em class="icon ni ${changeIcon} ${changeClass}"></em> <span class="${changeClass}">${percentageChange.toFixed(2)}%</span>` 
                        : `<span class="${changeClass}">${percentageChange.toFixed(2)}%</span>`; // If percentage is 0, just display the percentage without the icon

                    const div = $(`
                        <div class="col-xxl-3 col-sm-6">
                            <div class="card" style="background: linear-gradient(to right, #FFA500, #FF4500);">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title ${changeClass}">${stat.title}</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <h4 class="${stat.color}" >${stat.today}</h4>
                                            </div>
                                            <div class="info ${changeClass}">
                                                <span class="change ${changeIcon0} text-white">
                                                    ${iconHTML}
                                                </span>
                                                <span class="${changeClass}" style="font-size:12px;" >vs. la semaine passée (${stat.last_week})</span>
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
        $('#div_nbre_message').show();

        $.ajax({
            url: '/api/stat_nbre/' + $('#id_agence').val(),
            method: 'GET',
            success: function(response) {
                const data = response.data;

                const contenuDiv = $('#div_nbre');

                const stats = [
                    {  
                        title: 'Solde Caisse', 
                        count: (data.solde.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') ?? 0 ) + ' Fcfa',
                        icon: 'wallet-fill',
                        color: 'success', 
                    },
                    { 
                        title: 'Total Clients', 
                        count: data.client,
                        icon: 'user-group-fill',
                        color: 'primary', 
                    },
                    { 
                        title: 'Assurance Acceptées', 
                        count: data.assurance,
                        icon: 'building-fill',
                        color: 'warning', 
                    },
                    { 
                        title: 'Agence', 
                        count: data.agence,
                        icon: 'map-pin-fill',
                        color: 'danger', 
                    },
                ];

                $('#div_nbre_message').hide();

                stats.forEach(function(stat) {

                    const div = $(`
                        <div class="col-xxl-3 col-sm-6" >
                            <div class="card pricing text-center" style="background: linear-gradient(to right, #87CEEB, #4682B4);">
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
        $('#div_table_message').show();
        $('#div_table').hide();
        $('#div_table').empty();

        $.ajax({
            url: '/api/stat_table',
            method: 'GET',
            success: function(response) {
                const data = response.data;

                const contenuDiv = $('#div_table');

                const div_header = $(`
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span>Code vente</span></div>
                        <div class="nk-tb-col tb-col-md"><span>Client</span></div>
                        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                        <div class="nk-tb-col"><span>Montant Total</span></div>
                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Statut</span></div>
                    </div>
                `);

                contenuDiv.append(div_header);

                $('#div_table_message').hide();
                $('#div_table').show();

                data.forEach(function(item) {

                    const div = $(`
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead">
                                    <a href="#">${item.code}</a>
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
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

                    contenuDiv.append(div);
                });
            },
            error: function() {
                // showAlert('danger', 'Impossible de generer le code automatiquement');
            }
        });
    }


});