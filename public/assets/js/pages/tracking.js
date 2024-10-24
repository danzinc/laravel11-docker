// base variable
const baseUrl = window.location.origin;
let locations,
    gmarker = [];
let markerCluster;
let map;
let interval;
let isRunning;
var infoWindow = new google.maps.InfoWindow();

// elements
const filterType = document.getElementById("type");
const filterPegawai = document.getElementById("pegawai");
const filterTanggal = document.getElementById("date");
const btnFilter = document.getElementById("btnFilter");

// functions
async function initMap() {
    var options = {
        zoom: 10,
        center: {
            lat: -6.890437602996826,
            lng: 109.62947845458984,
        },
    };
    map = new google.maps.Map(document.getElementById("map"), options);
    isRunning = true;
    interval = setInterval(async () => {
        gmarker.length = 0;
        if (markerCluster) markerCluster.clearMarkers();
        locations = await getAllUserLocation();
        for (let index = 0; index < locations.length; index++) {
            let location = locations[index];
            gmarker.push(addMarker(map, location, true));
        }

        markerCluster = new MarkerClusterer(map, gmarker, {
            imagePath:
                "https://cdn.jsdelivr.net/gh/googlemaps/v3-utility-library@07f15d84/markerclustererplus/images/m",
            zoomOnClick: false,
        });

        google.maps.event.addListener(
            markerCluster,
            "clusterclick",
            setClusterInfoWindow
        );
    }, 5000);
}

function addMarker(map, data, hasDetail) {
    let position = new google.maps.LatLng(data.lat, data.long);
    var updated = hasDetail
        ? new Date(data.updated_at)
        : new Date(data.updated_at);
    var options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    var detail = `
        <div class="container" style="max-width: 250px">
           <div class = "row">
               <div class = "col">
                   <p class="fw-bold" style="text-align: left;">Detail Informasi</p>
               </div>
           </div>
           <div class="row row-cols-lg-2 g-lg-1">
               <div class="col">
                   <div class="">Nama Pegawai</div>
               </div>
               <div class="col">
                   <div class="">NIP</div>
               </div>
               <div class="col">
                   <div class=" fw-bold">${
                       hasDetail ? data.pegawai.name : data.name
                   }</div>
               </div>
               <div class="col">
                   <div class=" fw-bold">${
                       hasDetail ? data.pegawai.nip : data.nip
                   }</div>
               </div>
         </div>
           <div class="row row-cols-lg-2 g-lg-1 mt-2">
               <div class="col">
                   <div class="">Terakhir Update</div>
               </div>
               <div class="col">
                   <div class="">Wilayah Kantor</div>
               </div>
               <div class="col">
                   <div class=" fw-bold">${updated.toLocaleDateString(
                       "id-ID",
                       options
                   )}</div>
               </div>
               <div class="col">
                   <div class=" fw-bold">${
                       hasDetail ? data.pegawai.wilayah.name : data.wilayah
                   }</div>
               </div>
         </div>
       </div>`;
    var marker = new google.maps.Marker({
        position,
        map: map,
        title: hasDetail ? data.pegawai.name : data.name,
    });
    google.maps.event.addListener(marker, "click", (e) => {
        clearInterval(interval);
        isRunning = false;
        hasDetail
            ? infoWindow.setContent(detail)
            : infoWindow.setContent(detail);
        infoWindow.open(map, marker);
        if (hasDetail) {
            infoWindow.addListener("closeclick", () => {
                if (!isRunning) initMap();
            });
        }
    });
    return marker;
}

async function getAllUserLocation() {
    const res = await fetch(`${baseUrl}/api/tracking`);
    const data = await res.json();
    return data.data;
}

async function getUserTrackingHistory() {
    let body = {
        user_name: filterPegawai.value,
        date: filterTanggal.value.replace("/", "-"),
    };
    const res = await fetch(`${baseUrl}/api/tracking/histories`, {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(body),
    });
    const data = await res.json();
    return data.data;
}

function setClusterInfoWindow(cluster) {
    var markers = cluster.getMarkers();
    var array = [];
    var num = 0;

    for (i = 0; i < markers.length; i++) {
        num++;
        array.push(markers[i].getTitle() + "<br>");
    }
    infoWindow.setContent(markers.length + " markers<br>" + array);
    infoWindow.setPosition(cluster.getCenter());
    infoWindow.open(map);
}

// event listener
window.onload = initMap();
filterType.addEventListener("change", () => {
    if (filterType.value == "history") {
        filterPegawai.disabled = false;
        filterTanggal.disabled = false;
        btnFilter.disabled = false;
    } else {
        filterPegawai.disabled = true;
        filterTanggal.disabled = true;
        btnFilter.disabled = true;
        if (!isRunning) initMap();
        filterPegawai.value = "";
        filterTanggal.value = "";
    }
});

btnFilter.addEventListener("click", async () => {
    clearInterval(interval);
    if (markerCluster) markerCluster.clearMarkers();
    gmarker.length = 0;
    isRunning = false;
    let histories = await getUserTrackingHistory();
    for (let index = 0; index < histories.length; index++) {
        const history = histories[index];
        gmarker.push(addMarker(map, history, false));
    }
    markerCluster = new MarkerClusterer(map, gmarker, {
        imagePath:
            "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    });
});
