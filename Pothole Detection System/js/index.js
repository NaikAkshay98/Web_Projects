// More API functions here:
// https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

// the link to your model provided by Teachable Machine export panel
//const URL = "https://teachablemachine.withgoogle.com/models/Ux419oRM/";
//const URL="https://teachablemachine.withgoogle.com/models/8O_OvzjC/";// old incorrect model
const URL = "https://teachablemachine.withgoogle.com/models/KBXS0BiO/"; //new correct model
//const URL="C:/Users/Akshay/Desktop/pothole4_3model/"
let model, webcam, labelContainer, maxPredictions;

// Load the image model and setup the webcam
async function init() {
	const modelURL = URL + "model.json";
	const metadataURL = URL + "metadata.json";
	
	document.getElementById("webcam-container").innerHTML = "";
	// load the model and metadata
	// Refer to tmImage.loadFromFiles() in the API to support files from a file picker
	// or files from your local hard drive
	// Note: the pose library adds "tmImage" object to your window (window.tmImage)
	model = await tmImage.load(modelURL, metadataURL);
	//maxPredictions = model.getTotalClasses();
	maxPredictions = 1;

	// Convenience function to setup a webcam
	const flip = true; // whether to flip the webcam
	webcam = new tmImage.Webcam(666,435, flip); // width, height, flip
	await webcam.setup(); // request access to the webcam
	await webcam.play();
	window.requestAnimationFrame(loop);

	// append elements to the DOM
	document.getElementById("webcam-container").appendChild(webcam.canvas);
	labelContainer = document.getElementById("label-container");
	for (let i = 0; i < maxPredictions; i++) { // and class labels
		labelContainer.appendChild(document.createElement("div"));
	}
	
}

async function loop() {
	webcam.update(); // update the webcam frame
		if ( stopLoop==true ) {
		stopLoop=false;
		return;
		}
	await predict();
	window.requestAnimationFrame(loop);
}

// run the webcam image through the image model
async function predict() {			
	// predict can take in an image, video or canvas html element
	const prediction = await model.predict(webcam.canvas);
	for (let i = 0; i < maxPredictions; i++) {
		//const classPrediction = prediction[i].className + ":" + prediction[i].probability.toFixed(2);
		$(".progress-bar").css("width", prediction[i].probability.toFixed(2) * 100 + "%");
		//labelContainer.childNodes[i].innerHTML = classPrediction;
		if(prediction[i].probability.toFixed(2)>0.70 && prediction[i].className=="Pothole"){
			//console.log(prediction[i].className);
			//document.getElementById("demo1").innerHTML=prediction[i].className;
			getLocation();
		}/*else{
				//console.log(prediction[i].className);
				document.getElementById("demo1").innerHTML=prediction[i].className;
		}*/
	}
}

var coordDisplay_array=[];

function getLocation() {
if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(showPosition);
} else { 
	document.getElementById("demo2").innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	//document.getElementById("demo2").innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
	var latlog_array=[];
	latlog_array.push(position.coords.latitude);
	latlog_array.push(position.coords.longitude);
	coordDisplay_array.push(latlog_array);
	document.getElementById("coord").value = coordDisplay_array;
	//console.log(coordDisplay_array);
	//console.log(coordDisplay_array.toString())
	//document.getElementById("tabDisplay").innerHTML=coordDisplay_array;
}
	var map
	function displayMap(){
		if (map != undefined) { map.remove(); }
		//Set the map center and zoom level
		 map = L.map('map').setView([19.2070221,72.84205109999999], 11);
		  
		mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
		  L.tileLayer(
			  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			  attribution: '&copy; ' + mapLink + ' Contributors',
			  maxZoom: 25,
			  }).addTo(map);
		
				//var points=[];
		//Change the size and color of circular markers here
		for (var i = 0; i < coordDisplay_array.length; i++) {
			circle = new L.circle([coordDisplay_array[i][0],coordDisplay_array[i][1]], 2, {
			fillOpacity: 1.0
			})
			.bindPopup(coordDisplay_array[i][0])
			.addTo(map);
			//points.push(circle);
		}
	}
var stopLoop=false;
async function end(){
	stopLoop=true;
	predict();
	await webcam.stop();
	//document.getElementById("webcam-container").innerHTML = "";
	//document.getElementById("label-container").innerHTML = "";
	//var webcamobj = document.getElementById("webcam-container");
	//webcamobj.remove();
}

$(document).ready(function(){
	displayMap();
});