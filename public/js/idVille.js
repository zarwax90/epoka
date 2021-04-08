//======================================================================
// CITY ID FILL
//======================================================================

const ville1 = document.getElementById('ville1');
const ville2 = document.getElementById('ville2');
const city1 = document.getElementById('city1');
const city2 = document.getElementById('city2');
const text1 = document.getElementById('text1');
const text2 = document.getElementById('text2');

ville1.addEventListener('input', () => {
    const index = [...city1.options]
        .map(o => o.value)
        .indexOf(ville1.value)
    if (index === -1) {
        text1.value = ""
    } else {
        text1.value = city1.options[index].id;
    }
})

ville2.addEventListener('input', () => {
    const index = [...city2.options]
        .map(o => o.value)
        .indexOf(ville2.value)
    if (index === -1) {
        text2.value = ""
    } else {
        text2.value = city2.options[index].id;
    }
})