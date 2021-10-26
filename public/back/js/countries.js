function getCountries() {
    fetch("https://wft-geo-db.p.rapidapi.com/v1/geo/countries", {
        "method": "GET",
        "headers": {
            "x-rapidapi-key": "83e948b576msh02107e46bc573cep15028ajsnedb83b6e5b97",
            "x-rapidapi-host": "wft-geo-db.p.rapidapi.com"
        }
    })
        .then(response => response.json())
        .then(json => {
            console.log(json);
        })
        // .catch(err => {
        //     console.error(err);
        // });
}


function getStates() {
    fetch("https://wft-geo-db.p.rapidapi.com/v1/geo/countries/US/regions", {
        "method": "GET",
        "headers": {
            "x-rapidapi-key": "83e948b576msh02107e46bc573cep15028ajsnedb83b6e5b97",
            "x-rapidapi-host": "wft-geo-db.p.rapidapi.com"
        }
    })
        .then(response => {
            console.log(response);
        })
        .catch(err => {
            console.error(err);
        });
}


function geCities() {
    fetch("https://wft-geo-db.p.rapidapi.com/v1/geo/countries/%7Bcountryid%7D/regions/%7Bregioncode%7D/cities", {
        "method": "GET",
        "headers": {
            "x-rapidapi-key": "83e948b576msh02107e46bc573cep15028ajsnedb83b6e5b97",
            "x-rapidapi-host": "wft-geo-db.p.rapidapi.com"
        }
    })
        .then(response => {
            console.log(response.body);
        })
        .catch(err => {
            console.error(err);
        });
}
