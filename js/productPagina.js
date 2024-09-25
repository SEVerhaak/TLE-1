let accordion
let ean
let userId
let url


startFetch()

function startFetch() {
    // Toon de laadtekst bij het starten van het laden
    document.getElementById('loading').style.display = 'flex';

    accordion = document.getElementsByClassName("accordion");
    ean = document.getElementById('meta-data-ean').innerHTML;
    userId = document.getElementById('meta-data-id').textContent;
    url = `https://world.openfoodfacts.org/api/v2/product/${ean}.json`;

    if (ean !== '' && ean) {
        try {
            console.log('starting the whole thing!')
            accordionInit();
            fetchResults();
        } catch (e) {
            //window.location.href = '../scanner'
            console.error('Error starting fetch request')
        }
    }
}

function accordionInit() {
    // voor de dropdown accordion menu's
    for (let i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener("click", function () {
            console.log(this)
            let panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
                this.classList.remove("active");
            } else {
                panel.style.display = "block";
                this.classList.add("active");
            }
        });
    }
}

// Gebruik de fetch-API om de data op te halen

function fetchResults() {
    console.log('start of fetch, ean= ' + ean)
    fetch(url)
        .then(response => {
            // Controleer of het verzoek succesvol was
            if (!response.ok) {
                window.location.href = '../scanner/index.php?error=Product_niet_gevonden!'
                throw new Error('Network response was not ok');
            }
            // Converteer de response naar JSON
            console.log('fetch complete')
            return response.json();
        })
        .then(data => {
            if (data && data.product) {
                console.log('handling data')

                //localStorage.setItem('data', JSON.stringify(data.product))
                document.getElementById('loading').style.display = 'none';

                dataHandler(data)
                let name

                getFavourite(ean, userId)

                if (data.product.brands && data.product.product_name) {
                    name = `${data.product.brands} - ${data.product.product_name}`
                    saveToHistory(ean, name, userId)
                } else {
                    name = 'N.A'
                    saveToHistory(ean, name, userId)
                }


            } else {
                window.location.href = '../scanner/index.php?error=Product_niet_gevonden!'
            }
        })
        .catch(error => {
            // Foutafhandeling als het verzoek mislukt
            console.error('Er is een fout opgetreden:', error);
            window.location.href = '../scanner/index.php?error=Product_niet_gevonden!'
        });
}

function getFavourite(ean, id) {
    if (userId !== '' && userId !== undefined && userId) {
        console.log('getting favourite!')
        const url = `../../api/favourite.php?ean=` + encodeURIComponent(`${ean}`) + `&id=` + encodeURIComponent(`${id}`)
        fetch(url)
            .then(response => {
                // Controleer of het verzoek succesvol was
                if (!response.ok) {
                    //window.location.href = '../scanner'
                    throw new Error('Network response was not ok');
                }
                // Converteer de response naar JSON
                return response.json();
            })
            .then(data => {
                const button = document.getElementsByClassName('save-info')[0]
                button.addEventListener('click', favouriteClickHandler)

                if (parseInt(data.favourite) !== 0) {
                    buttonStyleHandler('favourite')
                } else {
                    buttonStyleHandler('not-favourite')
                }

            })
            .catch(error => {
                // Foutafhandeling als het verzoek mislukt
                console.error('Er is een fout opgetreden:', error);
            });
    }
}

function buttonStyleHandler(type) {
    if (type === 'favourite') {
        const button = document.getElementsByClassName('save-info')[0]
        const text = document.getElementById('button-text')
        text.textContent = 'verwijder bewaard product'
        button.classList.add('color-red')
    } else {
        const button = document.getElementsByClassName('save-info')[0]
        const text = document.getElementById('button-text')
        text.textContent = 'bewaar product'
        button.classList.remove('color-red')
    }
}

function favouriteClickHandler() {
    if (userId !== '' && userId !== undefined && userId) {
        console.log('getting favourite!')
        const url = `../../api/set-favourite.php?ean=` + encodeURIComponent(`${ean}`) + `&id=` + encodeURIComponent(`${userId}`)
        fetch(url)
            .then(response => {
                // Controleer of het verzoek succesvol was
                if (!response.ok) {
                    //window.location.href = '../scanner'
                    throw new Error('Network response was not ok');
                }
                // Converteer de response naar JSON
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.result === "removed favourite") {
                    buttonStyleHandler('not-favourite')
                } else {
                    buttonStyleHandler('favourite')
                }
            })
            .catch(error => {
                // Foutafhandeling als het verzoek mislukt
                console.error('Er is een fout opgetreden:', error);
            });
    }
}


function saveToHistory(ean, name, id) {
    if (userId !== '' && userId !== undefined && userId) {
        console.log('saving to history!')
        const url = `../../api/history-add.php?ean=` + encodeURIComponent(`${ean}`) + `&name=` + encodeURIComponent(`${name}`) + `&id=` + encodeURIComponent(`${id}`)
        fetch(url)
            .then(response => {
                // Controleer of het verzoek succesvol was
                if (!response.ok) {
                    //window.location.href = '../scanner'
                    throw new Error('Network response was not ok');
                }
                // Converteer de response naar JSON
                return response.json();
            })
            .then(data => {

            })
            .catch(error => {
                // Foutafhandeling als het verzoek mislukt
                console.error('Er is een fout opgetreden:', error);
            });
    }
}

function dataHandler(data) {
    console.log(data.product.categories_hierarchy)
    let tag = data.product.categories_hierarchy
    let last = tag[tag.length-1]
    console.log(last)
    console.log(data);
    if (data.product.brands !== undefined && data.product.brands !== '' && data.product.brands !== null) {
        if (data.product.product_name !== undefined && data.product.product_name !== '' && data.product.product_name !== null) {
            document.getElementById('product-name').innerHTML = `${data.product.brands} - ${data.product.product_name}`;
        } else {
            document.getElementById('product-name').innerHTML = `${data.product.brands}`;
        }
    } else if (data.product.product_name !== undefined && data.product.product_name !== '' && data.product.product_name !== null) {
        document.getElementById('product-name').innerHTML = `${data.product.product_name}`;
    } else {
        document.getElementById('product-name').innerHTML = `N.A`;
    }


    if (data.product.image_front_small_url !== undefined && data.product.image_front_small_url !== '' && data.product.image_front_small_url !== null) {
        document.getElementById('product-image').src = `${data.product.image_front_small_url}`;
    } else {
        document.getElementById('product-image').src = `../../images/placeholder.webp`;
    }

    if (data.product.categories !== undefined && data.product.categories !== '' && data.product.categories !== null) {
        document.getElementById('categories').innerHTML = `Categorieën: ${data.product.categories}`;
    } else {
        console.log('categorien')
        document.getElementById('categories').innerHTML = 'Geen categorieën gevonden'
    }

    let quantityGlobal

    if (data.product.product_quantity !== undefined && data.product.product_quantity !== '' && data.product.product_quantity !== null) {
        if (data.product.product_quantity_unit !== undefined && data.product.product_quantity_unit !== '' && data.product.product_quantity_unit !== null) {
            document.getElementById('quantity').innerHTML = `Hoeveelheid: ${data.product.product_quantity} ${data.product.product_quantity_unit}`;
            quantityGlobal = parseInt(`${data.product.product_quantity}`)
        } else {
            document.getElementById('quantity').innerHTML = `Hoeveelheid: ${data.product.product_quantity}`;
            quantityGlobal = parseInt(`${data.product.product_quantity}`)
        }
    } else {
        console.log(`Geen gewicht bekend voor dit product`)
        document.getElementById('quantity').innerHTML = `Geen gewicht bekend voor dit product`;
    }

    if (data.product.ecoscore_grade !== '' && data.product.ecoscore_grade !== null && data.product.ecoscore_grade && data.product.ecoscore_grade !== 'not-applicable') {
        document.getElementById('ecoscore-image').src = `../../images/eco-score/ecoscore-${data.product.ecoscore_grade}.svg`;
        document.getElementById('eco-score-color').classList.remove('eco-color-unknown')
        document.getElementById('eco-score-color').classList.add(`eco-color-${data.product.ecoscore_grade}`)

        if (data.product.ecoscore_grade === 'e' || data.product.ecoscore_grade === 'a') {
            let collection = document.getElementsByClassName('results')
            for (let i = 0; i < collection.length; i++) {
                collection[i].classList.add('color-white')
            }
        }
    } else {
        document.getElementById('ecoscore-image').src = `../../images/eco-score/ecoscore-unknown.svg`;
    }


    if (data.product.ecoscore_score !== undefined && data.product.ecoscore_score !== '') {
        document.getElementById('co2-info').innerHTML = `Ecoscore: ${data.product.ecoscore_score}%`;

        if (data.product.ecoscore_data.agribalyse.co2_total !== undefined && data.product.ecoscore_data.agribalyse.co2_total !== '') {
            const co2Per100g = Math.round(data.product.ecoscore_data.agribalyse.co2_total * 100);
            const carEmissionsPerKm = 120; // average car emissions in grams of CO2 per kilometer
            const kmEquivalent = (co2Per100g / carEmissionsPerKm).toFixed(2); // equivalent km driven

            document.getElementById('co2-info').innerHTML = `${co2Per100g} gram CO2 uitstoot per 100 gram product`;
            document.getElementById('co2-score').innerHTML = `${co2Per100g} gr`;

            // Create new LI element to display km equivalent
            // Create new LI element to display km equivalent
            const kmInfo = document.createElement('li');
            kmInfo.id = 'km-info';
            kmInfo.innerHTML = `Dat is gelijk aan ${kmEquivalent} km rijden met een gemiddelde auto.`;

            // Append it after co2-info
            document.getElementById('co2-info').parentNode.insertBefore(kmInfo, document.getElementById('co2-info').nextSibling);

            if (quantityGlobal && quantityGlobal !== ''){
                const totalEmissions = (co2Per100g * (quantityGlobal / 100)).toFixed(0); // Round to 2 decimal places
                const totalInfo = document.createElement('li');
                totalInfo.id = 'total-info';
                totalInfo.innerHTML = `Dit product stoot in totaal ${totalEmissions} gram CO2 uit.`;

                // Append it after km-info
                document.getElementById('km-info').parentNode.insertBefore(totalInfo, document.getElementById('km-info').nextSibling);
            }


        } else {
            document.getElementById('co2-info').innerHTML = `Onbekend`;
            document.getElementById('co2-score').innerHTML = `Onbekend`;

            // Remove km-info if it exists
            const kmInfo = document.getElementById('km-info');
            if (kmInfo) {
                kmInfo.remove();
            }
        }
    } else {
        document.getElementById('co2-score').innerHTML = `Onbekend`;
        document.getElementById('co2-info').innerHTML = `Onbekend`;

        // Remove km-info if it exists
        const kmInfo = document.getElementById('km-info');
        if (kmInfo) {
            kmInfo.remove();
        }
    }


    if (data.product.packaging !== undefined && data.product.packaging !== '') {
        document.getElementById('packaging').innerHTML = `Verpakking: ${data.product.packaging}`;
    } else {
        document.getElementById('packaging').innerHTML = `Verpakking: Onbekend`;
    }


    if (data.product.packaging_recycling_tags !== undefined && data.product.packaging_recycling_tags !== '' && data.product.packaging_recycling_tags.length !== 0) {
        document.getElementById('recycling').innerHTML = `Recycling informatie: ${data.product.packaging_recycling_tags}`;
    } else {
        document.getElementById('recycling').innerHTML = `Recycling informatie: Onbekend`;
    }

    if (data.product.origins !== undefined && data.product.origins !== '') {
        document.getElementById('transport').innerHTML = `Transport methode: ${data.product.origins}`;
    } else {
        document.getElementById('transport').innerHTML = `Transport methode: Onbekend`;
    }

    console.log(data.product.packaging_recycling_tags.length)

}
