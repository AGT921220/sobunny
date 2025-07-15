const axios = require('axios');

const url = 'https://sobunny.com';

// Función para hacer una petición
async function makeRequest(index) {
    try {
        const response = await axios.get(url);
        console.log(`Request ${index + 1}: ${response.status}`);
    } catch (error) {
        console.error(`Request ${index + 1} failed: ${error.message}`);
    }
}

// Ejecutar 1000 peticiones simultáneamente
async function sendRequestsSimultaneously() {
    const promises = [];
    for (let i = 0; i < 1000; i++) {
        promises.push(makeRequest(i));
    }
    await Promise.all(promises);
    console.log('All requests completed');
}

sendRequestsSimultaneously();
