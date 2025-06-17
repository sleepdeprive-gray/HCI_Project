document.addEventListener("DOMContentLoaded", showPieChart);

function showPieChart() {
    console.log("pie-chart");
    const science = document.getElementById('scienceVALUES').value;
    const scinceval = parseInt(science,10);
 const fantasy = document.getElementById('fantasyVALUES').value;
    const fantasyval = parseInt(fantasy,10);
     
     const narrative = document.getElementById('narrativeVALUES').value;
    const narrativeval = parseInt(narrative,10);

     const novel = document.getElementById('novelVALUES').value;
    const novelval = parseInt(novel,10);

    const mystery = document.getElementById('mysteryVALUES').value;
    const mysteryval = parseInt(mystery,10);

    const fictional = document.getElementById('fictionalVALUES').value;
    const fictionalval = parseInt(fictional,10);

    const history = document.getElementById('historyVALUES').value;
    const historyval = parseInt(history,10);

    
    console.log(scinceval,fantasyval,narrativeval,novelval,mysteryval,fictionalval,historyval);
    
    

    let slices = [
        { size: scinceval, color: '#BB5C22', label: 'Science' },
        { size: fantasyval, color: 'rgb(158, 79, 29)', label: 'Fantasy' },
        { size: novelval, color: 'rgb(136, 68, 25)', label: 'Novel' },
        { size: narrativeval, color: 'rgb(117, 59, 22)', label: 'Narrative' },
        { size: historyval, color: 'rgb(97, 49, 19)', label: 'History' },
        { size: mysteryval, color: 'rgb(85, 42, 16)', label: 'Mystery' },
        { size: fictionalval, color: 'rgb(68, 34, 13)', label: 'Fictional' }
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
            <div class="legend-item" style="display:flex; align-items: center;margin-bottom:5px;margin-left:-20px">
                <div class="legend-color" style="background-color: ${slice.color}; width:20px; height:20px;"></div>
                <span style="margin-left:10px; font-weight:bold">${slice.label}: ${percentage}%</span>
            </div>
        `;
    }).join('');
}
