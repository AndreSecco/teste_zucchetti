import axios from 'axios'

const getApiUrl = () => {
    const currentHost = window.location.hostname

    if(currentHost == 'localhost') { return 'http://localhost/teste_zucchetti/backend' }
    if(currentHost.includes('andrecode.com.br')) { return 'https://andrecode.com.br/teste_zucchetti/backend' }
}

const client = axios.create({
    baseURL: getApiUrl(),
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json;charset=UTF-8'
    }
})

export default client