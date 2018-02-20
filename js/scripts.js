window.addEventListener('load', GvvOnVrViewLoad);

function GvvOnVrViewLoad() {

    var allViewers = document.getElementsByClassName( 'gvv-vrview');

    [].forEach.call( allViewers, function ( viewer ) {

        if( viewer.id ){

            // Selector '#vrview' finds element with id 'vrview'.
            var vrView = new VRView.Player( '#' + viewer.id, {
                image: viewer.dataset.imageUrl,
                is_stereo: false,
                width: viewer.offsetWidth,
                height: Math.floor( ( viewer.offsetWidth / 19 ) * 9 )
            });
        }
    })
}