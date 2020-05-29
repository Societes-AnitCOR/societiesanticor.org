
function get_json () {
    $.getJSON("/entreprises-json")
        .done(load_data) 
}


// Max description length
var max_length = 115;

// We're going to put the companies data here after extraction
var companies = [];

// Get handles on elements in the page
var results = document.getElementById('results')
var search = document.getElementById('search')
var search_location = document.getElementById('search_location')


// Function to normalise text for searching
function normalise_text(str) {
    return str
        .toLowerCase()  //case insensitive 
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")  // remove accents
        .trim();
}

function filter_company(company) {
        if (text === '' // No "text" filtre is present
        || search_terms.every((term) => company.searchable.includes(term))) {
        if (location === ''  // No location Filter is present
            || location_terms.every((term) => company.searchable_location.includes(term))) {
            // Make this card visible
            company.card.classList.remove("d-none");
            return
        }
    }
}

// Function to update which company cards are visible based on the current filter
function update_filter() {
    // Normalise the next
    var text = normalise_text(search.value)
    // Break up the text into to "terms" that must all be present
    var search_terms = text.split(" ")

    // Do the same as above, but with the location filtre
    var location = normalise_text(search_location.value)
    var location_terms = location.split(" ")

    // Lets filter out the companies!
    companies.forEach(company => {

        if (text === '' // No "text" filtre is present
            || search_terms.every((term) => company.searchable.includes(term))) {
            if (location === ''  // No location Filter is present
                || location_terms.every((term) => company.searchable_location.includes(term))) {
                // Make this card visible
                company.card.classList.remove("d-none");
                return
            }
        }

        // This company card is not wanted, hide it!
        company.card.classList.add("d-none");
    })

}

// Data processing function called once the JSON has been loaded
function load_data(data) {
    
    console.log(data)
    companies = data;

    // Clear the DOM 
    results.innerHTML = ""

    // Render each company card
    companies.forEach(company => {

        // Generate the searchable text
        searchable = company.name
            + ' ' + company.branch_name
            + ' ' + company.description
            + ' ' + company.contribution
            + ' ' + company.complementaryInformations
        company.searchable = normalise_text(searchable)

        // Generate the searchable location text
        searchable_location = company.address
            + ' ' + company.postalCode
            + ' ' + company.city
        company.searchable_location = normalise_text(searchable_location)

        // Create this companies card
        const card = document.createElement('div');
        card.setAttribute('class', 'col ');
        card.setAttribute('id', 'company-cardcol-' + company['id']);
        company.card = card

        small_contribution = company.contribution.length > max_length ?
            company.contribution.substring(0, max_length - 3) + "..." :
            company.contribution;

        keywords = ""

        company.keywords.split(",").forEach(  (keyword) => { keywords+=`<span class="badge badge-keyword">` + keyword + `</span>` } )

        card.innerHTML = `<!-- Card for company : ` + company.id + ` - ` + company.name + ` --> 
<div class="card h-100" id="company-card-` + company.id + `">
    <div class="card-img-top" style="background-image:url(/uploads/companies/logos/` + company.logo + `)">
    </div>
    <div class="card-body">
        <h5 class="card-title">` + company.name + `<span class="city"> <i class="fas fa-map-marker-alt"></i> ` + company.city + ` - ` + company.postalCode + `</span></h5>
        <p class="card-text">` + small_contribution + `</p>
        <div class="badges"><span class="badge badge-branch">` + company.branch_name + `</span>` + keywords + `</div>
    </div>
</div>
`
        // Add this card to the Window DOM
        results.appendChild(card)
    });
}


window.addEventListener('DOMContentLoaded', get_json)
