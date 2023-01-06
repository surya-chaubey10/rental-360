<input type="text"required id="autocomplete">

<script>
function initAutocomplete() {
   new google.maps.places.Autocomplete(
          (document.getElementById('autocomplete')),
          {types: ['geocode']}
   );
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCjAfDdE-e-WBvAAUcFuvtKVUonwILoI8&libraries=places&callback=initAutocomplete"
                async defer></script>

