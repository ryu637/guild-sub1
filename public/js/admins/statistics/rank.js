// プロジェクトrequired rank 横棒グラフ
$.ajax({
    url: projectRankDataUrl,
    method: "GET",
    success: function (response) {
        const ranks = [1, 2, 3, 4, 5];
        const data = response.counts;

        const ctx = document.getElementById('projectRanksChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ranks.map(r => `★`.repeat(r)),
                datasets: [{
                    data: data,
                    backgroundColor: '#555555',  // 濃いグレー統一
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            generateLabels: (chart) => [{
                                text: '★ Project Rank',
                                fillStyle: '#FFD700', // 星マークを黄色
                                strokeStyle: '#000',
                                hidden: false,
                                index: 0
                            }]
                        }
                    },
                    datalabels: { display: false } // 数値非表示
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        } 
                    },
                    y: {
                        ticks: {
                            color: '#FFD700', // 星マークを黄色に
                            font: { weight: 'bold', size: 16 }
                        }
                    }
                }
            }
        });
    },
    error: function (error) { console.error("プロジェクトrank取得エラー:", error); }
});

// フリーランサーrank 横棒グラフ
$.ajax({
    url: freelancerRankDataUrl,
    method: "GET",
    success: function (response) {
        const ranks = [1, 2, 3, 4, 5];
        const data = response.counts;

        new Chart(document.getElementById('freelancerRanksChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ranks.map(r => `★`.repeat(r)),
                datasets: [{
                    data: data,
                    backgroundColor: '#555555', // 濃いグレー統一
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            generateLabels: (chart) => [{
                                text: '★ Freelancer Rank',
                                fillStyle: '#FFD700', // 黄色の星マーク
                                strokeStyle: '#000',
                                hidden: false,
                                index: 0
                            }]
                        }
                    },
                    datalabels: { display: false } // 数値非表示
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        } 
                    },
                    y: {
                        ticks: {
                            color: '#FFD700', // y軸ラベルを黄色
                            font: { weight: 'bold', size: 16 }
                        }
                    }
                }
            }
        });
    },
    error: function (error) { console.error("フリーランサーrank取得エラー:", error); }
});