const passengers = document.getElementById("passengers");
if(passengers){
    passengers.addEventListener('click', e => {
        if(e.target.className === 'btn-danger btn deleteBtn'){
            if(confirm('Are you sure?')){
                let id = e.target.getAttribute('data-id');

                fetch(`/main/deletePassenger/${id}`,{
                    method: "DELETE"
                }).then( res => window.location.reload());
            }
        }
    })
}
const trips = document.getElementById("trips");
if(trips){
    trips.addEventListener('click', e => {
        if(e.target.className === 'btn-danger btn deleteBtn'){
            if(confirm('Are you sure?')){
                let id = e.target.getAttribute('data-id');

                fetch(`/main/deleteTrip/${id}`,{
                    method: "DELETE"
                }).then( res => window.location.reload());
            }
        }
    })
}
