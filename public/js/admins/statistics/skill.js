// プロジェクトの要求スキルTop10 グラフ
$.ajax({
    url: projectSkillTop10DataUrl,
    method: "GET",
    success: function (response) {
        if (!response || response.length === 0) {
            console.error("プロジェクトスキルTop10データなし", response);
            return;
        }

        const skillNames = response.map(item => item.name);
        const skillCounts = response.map(item => item.count);

        const canvas = document.getElementById('projectSkillTop10Chart');
        // ここで高さを決める！（1項目40pxぐらいが見やすい）
        canvas.height = response.length * 30;

        new Chart(document.getElementById('projectSkillTop10Chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: skillNames,
                datasets: [{
                    label: 'Project Skill Count',
                    data: skillCounts,
                    backgroundColor: skillNames.map(name => getSkillColor(name)) 
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: { 
                    x: { 
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        }    
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    },
    error: function (error) { console.error("プロジェクトスキルTop10取得エラー", error); }
});

// フリーランサースキルTop10 グラフ
$.ajax({
    url: freelancerSKillTop10DataUrl,
    method: "GET",
    success: function (response) {
        console.log("フリーランサースキル取得データ",response);
        if (!response || response.length === 0) {
            console.error("フリーランサースキルTop10データなし", response);
            return;
        }

        const skillNames = response.map(item => item.name);
        const skillCounts = response.map(item => item.count);

        const canvas = document.getElementById('freelancerSkillTop10Chart');
        console.log(canvas)
        // ここで高さを決める！（1項目40pxぐらいが見やすい）
        canvas.height = response.length * 30;

        new Chart(document.getElementById('freelancerSkillTop10Chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: skillNames,
                datasets: [{
                    label: 'Freelancer Skill Count',
                    data: skillCounts,
                    backgroundColor: skillNames.map(name => getSkillColor(name))
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: { 
                    x: { 
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 2
                        } 
                    } 
                },
                plugins: { legend: { display: false } }
            }
        });
    },
    error: function (error) { console.error("フリーランサースキルTop10取得エラー", error); }
});

// プロジェクトのスキル推移グラフ
$.ajax({
    url: projectSkillTrendDataUrl,
    method: "GET",
    success: function (response) {
        if (!response || response.length === 0) {
            console.error("スキルデータがありません。", response);
            return;
        }

        const formattedWeeks = formatWeekRangeLabels(response.weeks);
        const datasets = response.skills.map(skill => ({
            label: skill.name,
            data: skill.weekly_counts,
            borderColor: getSkillColor(skill.name),
            backgroundColor: getSkillColor(skill.name) + '33', // 透過背景(任意)
            fill: false
        }));

        const canvas = document.getElementById('projectSkillsChart');

        new Chart(document.getElementById('projectSkillsChart').getContext('2d'), {
            type: 'line',
            data: { labels: formattedWeeks, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                     y:{ 
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 1
                        } 
                    }
                },
                plugins: {
                    legend: getLegendOptions()
                }
            }
        });
    },
    error: function (error) { console.error("スキルデータ取得エラー:", error); }
});

// フリーランサーのスキル推移グラフ
$.ajax({
    url: freelancerSKillTrendDataUrl,
    method: "GET",
    success: function (response) {
        if (!response || response.length === 0) {
            console.error("フリーランサースキルデータがありません。", response);
            return;
        }

        const formattedWeeks = formatWeekRangeLabels(response.weeks);
        const datasets = response.skills.map(skill => ({
            label: skill.name,
            data: skill.weekly_counts,
            borderColor: getSkillColor(skill.name),
            backgroundColor: getSkillColor(skill.name) + '33', // 透過背景(任意)
            fill: false
        }));

        const canvas = document.getElementById('freelancerSkillsChart');
        // canvas.height = response.skills.length * 30;

        new Chart(document.getElementById('freelancerSkillsChart').getContext('2d'), {
            type: 'line',
            data: { labels: formattedWeeks, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 10,
                        ticks: {
                            stepSize: 1
                        } 
                    }
                },
                plugins: {
                    legend: getLegendOptions()
                }
            }
        });
    },
    error: function (error) { console.error("フリーランサースキルデータ取得エラー:", error); }
});