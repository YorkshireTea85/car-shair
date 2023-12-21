"use strict";

const latInput = document.getElementById("latitude");
const lngInput = document.getElementById("longitude");

const CONFIGURATION = {
  "ctaTitle": "Checkout",
  "mapOptions": {"center":{"lat":37.4221,"lng":-122.0841},"fullscreenControl":false,"mapTypeControl":false,"streetViewControl":false,"zoom":17,"zoomControl":false,"maxZoom":22,"mapId":""},
  "mapsApiKey": "AIzaSyB5kdkoJyTq-MCgYuBWBrjnuU-ZQbfwopc",
  "capabilities": {"addressAutocompleteControl":true,"mapDisplayControl":false,"ctaControl":false}
};

const SHORT_NAME_ADDRESS_COMPONENT_TYPES =
    new Set(['street_number', 'administrative_area_level_1', 'postal_code']);

const ADDRESS_COMPONENT_TYPES_IN_FORM = [
  'location',
  'locality',
  'administrative_area_level_1',
  'postal_code',
  'country',
];

function getFormInputElement(componentType) {
  return document.getElementById(`${componentType}-input`);
}

function fillInAddress(place) {
  function getComponentName(componentType) {
    for (const component of place.address_components || []) {
      if (component.types[0] === componentType) {
        return SHORT_NAME_ADDRESS_COMPONENT_TYPES.has(componentType) ?
            component.short_name :
            component.long_name;
      }
    }
    return '';
  }

  function getComponentText(componentType) {
    return (componentType === 'location') ?
        `${getComponentName('street_number')} ${getComponentName('route')}` :
        getComponentName(componentType);
  }

  for (const componentType of ADDRESS_COMPONENT_TYPES_IN_FORM) {
    getFormInputElement(componentType).value = getComponentText(componentType);
  }
}

async function initMap() {
  const {Autocomplete} = google.maps.places;

  const autocomplete = new Autocomplete(getFormInputElement('location'), {
    fields: ['address_components', 'geometry', 'name'],
    types: ['address'],
  });

  autocomplete.addListener('place_changed', () => {
    const place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert(`No details available for input: '${place.name}'`);
      return;
    }
    fillInAddress(place);
    console.dir(latInput);
    latInput.value = place.geometry.location.lat();
    lngInput.value = place.geometry.location.lng();
  });

  
}