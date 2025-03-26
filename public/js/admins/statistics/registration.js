// 新規登録者数・プロジェクト数のグラフ描画
$.ajax({
    url: statisticsDataUrl,
    method: "GET",
    success: function (response) {
        if (!response || !response.weeks) {
            console.error("データが正しく取得できませんでした:", response);
            return;
        }

        const formattedLabels = formatWeekRangeLabels(response.weeks);

        // カンパニー登録数グラフ
        const ctxCompanies = document.getElementById('companyRegistrationsChart').getContext('2d');
        new Chart(ctxCompanies, {
            type: 'line',
            data: {
                labels: formattedLabels,
                datasets: [{
                    label: 'Company Registrations',
                    data: response.companyCounts,
                    borderColor: 'orange',
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    fill: true
                }]
            },
            options: { 
                responsive: true, 
                scales: { 
                    y: { 
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        } 
                    } 
                },
                plugins: {
                    legend: { display: false }
                } 
            }
        });

        // フリーランサー登録数グラフ
        const ctxFreelancers = document.getElementById('freelancerRegistrationsChart').getContext('2d');
        new Chart(ctxFreelancers, {
            type: 'line',
            data: {
                labels: formattedLabels,
                datasets: [{
                    label: 'Freelancer Registrations',
                    data: response.freelancerCounts,
                    borderColor: 'green',
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                    fill: true
                }]
            },
            options: { 
                responsive: true, 
                scales: { 
                    y: { 
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        } 
                    } 
                },
                plugins: {
                    legend: { display: false }
                } 
            }
        });

        // プロジェクト数グラフ
        const ctxProjects = document.getElementById('projectsChart').getContext('2d');
        new Chart(ctxProjects, {
            type: 'line',
            data: {
                labels: formattedLabels,
                datasets: [{
                    label: 'Number of Projects',
                    data: response.projectCounts,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    fill: true
                }]
            },
            options: { 
                responsive: true, 
                scales: { 
                    y: { 
                        beginAtZero: true,
                        suggestedMax: 20,
                        ticks: {
                            stepSize: 2
                        } 
                    } 
                },
                plugins: {
                    legend: { display: false }
                } 
            }
        });
    },
    error: function (error) { console.error("統計データ取得エラー:", error); }
});
