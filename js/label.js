// https://developers.google.com/maps/documentation/javascript/overlays?hl=pt-br#CustomOverlays

function Label(position, icon, text, cssClass) {
    this.position = position;
    this.icon = new Image();
    this.icon.src = icon;
    this.text = text;
    this.cssClass = cssClass;

    this.div = null;
}

Label.prototype = new google.maps.OverlayView();

Label.prototype.onAdd = function() {
    this.div = document.createElement('div');
    this.div.innerHTML = this.text;
    this.div.className = "overlay " + this.cssClass;
    this.div.style.position = 'absolute';

    var panes = this.getPanes();
    panes.overlayImage.appendChild(this.div);
};

Label.prototype.draw = function() {
    var overlayProjection = this.getProjection();
    var position = overlayProjection.fromLatLngToDivPixel(this.position);

    this.div.style.left = position.x - this.icon.width / 2 + 'px';
    this.div.style.top = position.y - this.icon.height + 'px';
    this.div.style.width = this.icon.width;
    this.div.style.height = this.icon.height;
};

Label.prototype.onRemove = function() {
    this.div.parentNode.removeChild(this.div);
    this.div = null;
};
