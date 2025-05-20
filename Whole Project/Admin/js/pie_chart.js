document.addEventListener("DOMContentLoaded", showPieChart);

function showPieChart() {
    console.log("pie-chart");

    let slices = [
        { size: 100, color: '#5d8878', label: 'Science' },
        { size: 100, color: '#567c6e', label: 'Fantasy' },
        { size: 100, color: '#47665b', label: 'Fantasy' },
        { size: 100, color: '#3c554c', label: 'Fantasy' },
        { size: 100, color: '#31463e', label: 'Fictional' }
    ];

    const total = slices.reduce((acc, slice) => acc + slice.size, 0);
    let startAngle = 0;

    const canvas = document.getElementById('pie-chart');
    const ctx = canvas.getContext("2d");
    const centerX = canvas.width / 2;
    const centerY = canvas.height / 2;
    const radius = canvas.width / 2;

    slices.forEach(slice => {
        const angle = (slice.size / total) * Math.PI * 2;

        // Draw the slice
        ctx.beginPath();
        ctx.moveTo(centerX, centerY);
        ctx.arc(centerX, centerY, radius, startAngle, startAngle + angle);
        ctx.closePath();
        ctx.fillStyle = slice.color;
        ctx.fill();

        startAngle += angle;
    });

    // Add the circle in the middle to create the donut effect
    const donutRadius = radius * 0.6;
    ctx.beginPath();
    ctx.arc(centerX, centerY, donutRadius, 0, Math.PI * 2);
    ctx.fillStyle = 'white';
    ctx.fill();

    // Add the description in the center
    ctx.fillStyle = 'black';
    ctx.font = 'bold 20px Arial';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('Total', centerX, centerY - 10);
    ctx.font = '16px Arial';
    ctx.fillText(`${total}`, centerX, centerY + 20);

    // Add the legend to the right
    const legend = document.getElementById("pie-chart-legend");
    legend.innerHTML = slices.map(slice => {
        const percentage = ((slice.size / total) * 100).toFixed(2);
        return `
            <div class="legend-item" style="display:flex; align-items: center;margin-bottom:10px;margin-left:-20px">
                <div class="legend-color" style="background-color: ${slice.color}; width:20px; height:20px; border: 1px solid black"></div>
                <span style="margin-left:10px; color:white; font-weight:bold">${slice.label}: ${percentage}%</span>
            </div>
        `;
    }).join('');
}
