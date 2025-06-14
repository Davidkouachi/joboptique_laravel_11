$(document).ready(function () { 

    $('#solde').hide();
    $('#btn_fermer').hide();
    $('#btn_ouvert').hide();
    $('#chargement').hide();
    $('#div_operation').hide();
    $('#message').hide();

    Verfication_statut();

    select_annee('#anne_op');
    select_annee('#anne_client');
    select_annee('#anne_eva_vente');
    select_magasin('#magasin_d_vente');

    graph_op();
    graph_eva_vente();
    graph_vente_prevision();
    graph_client();

    $("#anne_op").on('change', graph_op);
    $("#anne_eva_vente").on('change', graph_eva_vente);
    $("#anne_client").on('change', graph_client);

    function graph_op() 
    {
        $('#div_graph_op_message').show();
        const yearSelect = $("#anne_op").val();

        const contenug = $("#contenu_graph_op");
        contenug.empty();

        const divcon = $(`
            <div class="card-body" id="graph_op" ></div>
            <div class="card-body" id="graphT_op" ></div>
        `);

        contenug.append(divcon);

        fetch('/api/bilan_op/' + yearSelect +'/'+ $('#id_agence').val())
            .then(response => response.json())
            .then(data => {

                $('#div_graph_op_message').hide();

                const monthlyStats = data.monthlyStats;
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',];

                const entrer = generateMonthlyData(monthlyStats.entrer, months);
                const sortie = generateMonthlyData(monthlyStats.sortie, months);
                const total = generateMonthlyData(monthlyStats.total, months);

                var options = {
                    chart: {
                        height: 300,
                        type: "line",
                        toolbar: {
                            show: false,
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: "smooth",
                        width: 3,
                    },
                    series: [{
                            name: "Entrées",
                            data: entrer,
                        },
                        {
                            name: "Sorties",
                            data: sortie,
                        },
                        {
                            name: "Total",
                            data: total,
                        }, 
                    ],
                    grid: {
                        borderColor: "#d8dee6",
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 10,
                            left: 0,
                        },
                    },
                    markers: {
                        size: 1
                    },
                    xaxis: {
                        categories: [
                            "Janv",
                            "Fév",
                            "Mar",
                            "Avr",
                            "Mai",
                            "Jui",
                            "Juil",
                            "Aôut",
                            "Sept",
                            "Oct",
                            "Nov",
                            "Déc",
                        ],
                    },
                    yaxis: {
                        labels: {
                            show: true,
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa";
                            },
                            offsetX: -10,
                        },
                    },
                    colors: ["#0ebb13", "#ff5a39", "#436ccf"],
                    markers: {
                        size: 0,
                        opacity: 0.5,
                        colors: ["#0ebb13", "#ff5a39", "#436ccf"],
                        strokeColor: "#ffffff",
                        strokeWidth: 1,
                        hover: {
                            size: 7,
                        },
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+" Fcfa";
                            },
                        },
                    },
                };
                var chart = new ApexCharts(document.querySelector("#graph_op"), options);
                chart.render();

                const stat = $(`
                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <div style="background-color: #0ebb13;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <em class="ni ni-money text-white fs-4"></em>
                            <span class="me-1 text-white ps-1">+ ${data.total_entrer.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa</span>
                            <span class="fw-semibold">Entrées</span>
                        </div>
                        <div style="background-color: #ff5a39;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <em class="ni ni-money text-white fs-4"></em>
                            <span class="me-1 text-white ps-1">- ${data.total_sortie.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa</span>
                            <span class="fw-semibold">Sorties</span>
                        </div>
                        <div style="background-color: #436ccf;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <em class="ni ni-money text-white fs-4"></em>
                            <span class="me-1 text-white ps-1">${data.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa</span>
                            <span class="fw-semibold">Total</span>
                        </div>
                    </div>
                `);

                $('#graphT_op').append(stat);

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);

                

            });
    }

    function graph_eva_vente() 
    {
        $('#div_graph_eva_vente_message').show();
        const yearSelect = $("#anne_eva_vente").val();

        const contenug = $("#contenu_graph_eva_vente");
        contenug.empty();

        const divcon = $(`
            <div class="card-body" id="graph_eva_vente" ></div>
            <div class="card-body" id="graphT_eva_vente" ></div>
        `);

        contenug.append(divcon);

        fetch('/api/bilan_eva_vente/' + yearSelect +'/'+ $('#id_agence').val())
            .then(response => response.json())
            .then(data => {

                $('#div_graph_eva_vente_message').hide();

                const monthlyStats = data.monthlyStats;
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',];

                const client = generateMonthlyData(monthlyStats.client, months);
                const assurance = generateMonthlyData(monthlyStats.assurance, months);
                const total = generateMonthlyData(monthlyStats.total, months);

                var options = {
                    chart: {
                        height: 300,
                        type: "area",
                        toolbar: {
                            show: false,
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: "smooth",
                        width: 3,
                    },
                    series: [
                        // {
                        //     name: "Client",
                        //     data: client,
                        // },
                        // {
                        //     name: "Part Assurance",
                        //     data: assurance,
                        // },
                        {
                            name: "Total",
                            data: total,
                        }, 
                    ],
                    grid: {
                        borderColor: "#d8dee6",
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 10,
                            left: 0,
                        },
                    },
                    markers: {
                        size: 1
                    },
                    xaxis: {
                        categories: [
                            "Janv",
                            "Fév",
                            "Mar",
                            "Avr",
                            "Mai",
                            "Jui",
                            "Juil",
                            "Aôut",
                            "Sept",
                            "Oct",
                            "Nov",
                            "Déc",
                        ],
                        labels: {
                            style: {
                                colors: "#fff"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: true,
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + " Fcfa";
                            },
                            offsetX: -10,
                            style: {
                                colors: "#fff"
                            }
                        },
                    },
                    colors: ["#fff", "#0ebb13", "#3498db"],
                    markers: {
                        size: 0,
                        opacity: 0.5,
                        colors: ["#fff", "#0ebb13", "#3498db"],
                        strokeColor: "#ffffff",
                        strokeWidth: 1,
                        hover: {
                            size: 7,
                        },
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+" Fcfa";
                            },
                        },
                    },
                };
                var chart = new ApexCharts(document.querySelector("#graph_eva_vente"), options);
                chart.render();

                const stat = $(`
                    <div class="d-flex justify-content-center align-items-center">
                        <div style="background: transparent;" class="text-white">
                            <span class="fw-semibold text-white ps-1 h5">
                                Montant Total : ${data.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa
                            </span>
                        </div>
                    </div>
                `);

                // <div style="background-color: #ffa500;" class="d-flex justify-content-center align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                //             <em class="ni ni-money text-white fs-4"></em>
                //             <span class="me-1 text-white ps-1">
                //                 ${data.total_assurance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa
                //             </span>
                //             <span class="fw-semibold">Part Assurance</span>
                //         </div>
                //         <div style="background-color: #3498db;" class="d-flex justify-content-center align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                //             <em class="ni ni-money text-white fs-4"></em>
                //             <span class="me-1 text-white ps-1">
                //                 ${data.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} Fcfa
                //             </span>
                //             <span class="fw-semibold">Montant Total</span>
                //         </div>

                $('#graphT_eva_vente').append(stat);

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);

                

            });
    }

    function graph_vente_prevision() {
        $('#div_vente_prevision_message1').show();
        $('#div_vente_prevision_message2').show();

        const contenug1 = $("#contenu_graph_vente_prevision1");
        const contenug2 = $("#contenu_graph_vente_prevision2");
        contenug1.empty();
        contenug2.empty();

        fetch('/api/stat_prevision/' + $('#id_agence').val())
            .then(response => response.json())
            .then(data => {
                $('#div_vente_prevision_message1').hide();
                $('#div_vente_prevision_message2').hide();

                const months = [
                    "Janv", "Fév", "Mar", "Avr", "Mai", "Jui", 
                    "Juil", "Août", "Sept", "Oct", "Nov", "Déce"
                ];

                // Initialisation des tableaux pour 12 mois
                const smoothedVente = new Array(12).fill(0);
                const smoothedNombreVentes = new Array(12).fill(0);

                const currentYearVente = new Array(12).fill(0);
                const currentYearNombreVentes = new Array(12).fill(0);

                // Remplissage des données
                data.prevision.forEach(item => {
                    const monthIndex = item.month - 1;
                    smoothedVente[monthIndex] = item.smoothed_vente;
                    smoothedNombreVentes[monthIndex] = item.smoothed_nombre_ventes;
                    currentYearVente[monthIndex] = item.current_year_total;
                    currentYearNombreVentes[monthIndex] = item.current_year_sales;
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
                            name: "Montant Total (Fcfa)",
                            type: "line",
                            data: smoothedVente,
                            yaxisIndex: 0 // Associé à l'axe Y gauche (prix)
                        },
                        {
                            name: "Nombre de Ventes",
                            type: "column",
                            data: smoothedNombreVentes,
                            yaxisIndex: 1 // Associé à l'axe Y droit (nombre de ventes)
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
                                style: { colors: "#0ebb13" } // Vert pour les prix
                            }
                        },
                        {
                            opposite: true,
                            labels: {
                                style: { colors: "#3498db" } // Bleu pour les ventes
                            }
                        }
                    ],
                    colors: ["#0ebb13", "#3498db"], // Vert pour le prix, Bleu pour les ventes
                    markers: {
                        size: 4,
                        colors: ["#0ebb13", "#3498db"],
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

                var chart = new ApexCharts(document.querySelector("#contenu_graph_vente_prevision1"), options);
                chart.render();

                var options2 = {
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
                            name: "Montant Total (Fcfa)",
                            type: "line",
                            data: currentYearVente,
                            yaxisIndex: 0 // Associé à l'axe Y gauche (prix)
                        },
                        {
                            name: "Nombre de Ventes",
                            type: "column",
                            data: currentYearNombreVentes,
                            yaxisIndex: 1 // Associé à l'axe Y droit (nombre de ventes)
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
                                style: { colors: "#3498db" } // Vert pour les prix
                            }
                        },
                        {
                            opposite: true,
                            labels: {
                                style: { colors: "#0ebb13" } // Bleu pour les ventes
                            }
                        }
                    ],
                    colors: ["#3498db", "#0ebb13"], // Vert pour le prix, Bleu pour les ventes
                    markers: {
                        size: 4,
                        colors: ["#3498db", "#0ebb13"],
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

                var chart2 = new ApexCharts(document.querySelector("#contenu_graph_vente_prevision2"), options2);
                chart2.render();

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);
            });
    }

    function graph_client() 
    {
        $('#div_client_message').show();
        const yearSelect = $("#anne_client").val();

        const contenug = $("#contenu_graph_client");
        contenug.empty();

        const divcon = $(`
            <div class="card-body" id="graph_client" ></div>
            <div class="card-body" id="graphT_client" ></div>
        `);

        contenug.append(divcon);

        fetch('/api/bilan_client/' + yearSelect +'/'+ $('#id_agence').val())
            .then(response => response.json())
            .then(data => {

                $('#div_client_message').hide();

                const monthlyStats = data.monthlyStats;
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',];

                const total = months.map(month => monthlyStats.new[month] || 0);

                var options = {
                    chart: {
                        height: 300,
                        type: "area",
                        toolbar: {
                            show: false,
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: "smooth",
                        width: 3,
                    },
                    series: [
                        {
                            name: "Total",
                            data: total,
                        }, 
                    ],
                    grid: {
                        borderColor: "#d8dee6",
                        strokeDashArray: 5,
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 10,
                            left: 0,
                        },
                    },
                    markers: {
                        size: 1
                    },
                    xaxis: {
                        categories: [
                            "Janv",
                            "Fév",
                            "Mar",
                            "Avr",
                            "Mai",
                            "Jui",
                            "Juil",
                            "Aôut",
                            "Sept",
                            "Oct",
                            "Nov",
                            "Déc",
                        ],
                        labels: {
                            style: {
                                colors: "#fff"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: true,
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format y-axis labels
                            },
                            offsetX: -10,
                            style: {
                                colors: "#fff"
                            }
                        },
                    },
                    colors: ["#fff"],
                    markers: {
                        size: 0,
                        opacity: 0.5,
                        colors: ["#fff"],
                        strokeColor: "#ffffff",
                        strokeWidth: 1,
                        hover: {
                            size: 7,
                        },
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+" patient(s)";
                            },
                        },
                    },
                };
                var chart = new ApexCharts(document.querySelector("#graph_client"), options);
                chart.render();

                const stat = $(`
                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                        <div style="background: transparent;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <span class="me-1 text-white ps-1">
                                Nouveau Patient(s) : + ${data.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}
                            </span>
                        </div>
                        <div style="background: transparent;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <span class="me-1 text-white ps-1">
                                Homme(s) : ${data.homme.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}
                            </span>
                        </div>
                        <div style="background: transparent;" class="d-flex align-items-center box-shadow px-3 py-1 rounded-2 me-2 mb-2 text-white">
                            <span class="me-1 text-white ps-1">
                                Femme(s) : ${data.femme.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}
                            </span>
                        </div>
                    </div>
                `);

                $("#graphT_client").append(stat);

            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);

            });
    }



















    function generateMonthlyData(stats, defaultMonths) 
    {
        return defaultMonths.map(month => stats[month] || 0);
    }

});