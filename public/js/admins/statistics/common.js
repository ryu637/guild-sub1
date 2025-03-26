const skillColorMap = {};

function getSkillColor(skillName) {
    if (skillColorMap[skillName]) {
        return skillColorMap[skillName];
    }
    // なければ新規でランダムカラーを生成して保存
    const color = getRandomColor();
    skillColorMap[skillName] = color;
    return color;
}

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// "2025-02-10 ~ 2025-02-16" を "2/10 ~ 2/16" に変換
function formatWeekRangeLabels(weeks) {
    return weeks.map(weekRange => {
        const dates = weekRange.split(' ~ ');

        const formatDate = (dateStr) => {
            const [month, day] = dateStr.slice(5).split('-');
            return `${parseInt(month)}/${parseInt(day)}`; // parseIntで先頭ゼロを除去
        };

        const startDate = formatDate(dates[0]);
        const endDate = formatDate(dates[1]);
        return `${startDate} ~ ${endDate}`;
    });
}

function getLegendOptions() {
    return {
        position: 'left',
        labels: {
            usePointStyle: false,
            boxWidth: 8,   // ← ここで凡例アイコンの横幅
            boxHeight: 8,
            generateLabels: function(chart) {
                const data = chart.data;
                if (data.datasets.length) {
                    return data.datasets.map((dataset, i) => {
                        return {
                            text: dataset.label,
                            fillStyle: dataset.borderColor || dataset.backgroundColor,
                            strokeStyle: dataset.borderColor || dataset.backgroundColor,
                            lineWidth: 1,
                            hidden: !chart.isDatasetVisible(i),
                            index: i
                        };
                    });
                }
                return [];
            }
        }
    };
}