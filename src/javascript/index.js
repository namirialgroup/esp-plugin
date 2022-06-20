const express = require('express')
const path = require('path')
const https = require('https')
const axios = require('axios')
const jwt_decode = require('jwt-decode');
require('dotenv').config()

const host = process.env.HOST
const environmentname = process.env.ENVIRONMENT_NAME
const final = process.env.FINAL
const apikey = process.env.API_KEY
const attributes = process.env.ATTRIBUTES
const level = process.env.LEVEL
const spidtype = process.env.SPID_TYPE

// At request level
const agent = new https.Agent({
    rejectUnauthorized: false
});

const config = {
    headers: {
        "Esp-Api-Key": apikey
    },
    timeout: 10 * 1000,
    httpsAgent: agent
}

const app = express()
const port = 3000
const HOST = '0.0.0.0';

app.use(express.static(path.join(__dirname, 'public')))

// set the view engine to ejs
app.set('view engine', 'ejs');

// use res.render to load up an ejs view file

// index page
app.get('/', function(req, res) {
    res.render('index');
})
// key page
app.get('/key', async function(req, res) {
    let response = await axios
        .get(`${host}/api/secure/${environmentname}/getkey?attributes=${attributes}&level=${level}&spidType=${spidtype}`, config)

    console.log(response.data);
    let authnKey = response.data;
    let decoded = jwt_decode(authnKey);

    res.render('key',{
        props : decoded,
        loginurl: `${host}/${environmentname}/spidlogin?authnKey=${authnKey}&final=${final}`
    });
})

// user page
app.get('/user', async function(req, res) {

    let ID = req.query.sessionid;
    let key = req.query.sessionkey;

    let response = await axios
        .get(`${host}/api/secure/${environmentname}/getuser?ID=${ID}&key=${key}`, config)

    console.log(response.data);
    let userInfo = response.data;
    let decoded = jwt_decode(userInfo);

    res.render('user',{
        props : decoded
    });
})

app.listen(port, HOST, () => {
    console.log(`Namirial ESP plugin listening on port http://${HOST}:${port}`)
})
