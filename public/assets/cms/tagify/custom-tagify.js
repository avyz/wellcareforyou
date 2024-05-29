// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=doctor_language]');

// initialize Tagify on the above input node reference
var tagify = new Tagify(input)

// function test() {
//     // Serialize the form data
//     var formData = $("#doctorCreate").serializeArray();

//     // Get the Tagify data and parse it as JSON
//     var tagsData = tagify.value; // tagify.value gives you the array of tags

//     tagsData.forEach(function (tag) {
//         formData.push({ name: 'tags3[]', value: tag.value });
//     });

//     // Add Tagify data to formData array
//     console.log(formData);
// }