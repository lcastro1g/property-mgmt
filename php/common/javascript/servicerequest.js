
window.onload = function() {
    loadPropertyData();
}

// Populate / update service request form with existing data on select property change
function loadPropertyData() {
    var properties = document.getElementById('property');
    var selectedProperty = properties.options[properties.selectedIndex];
    var tenantID = selectedProperty.getAttribute('data-tenantid');
    var tenantName = selectedProperty.getAttribute('data-tenantname');
    var landlordID = selectedProperty.getAttribute('data-landlordid');
    var landlordName = selectedProperty.getAttribute('data-landlordname');
    var servicestaffID = selectedProperty.getAttribute('data-servicestaffid');
    var servicestaffName = selectedProperty.getAttribute('data-servicestaffname');
    
    
    document.getElementById('tenantname').value = tenantName;
    document.getElementById('landlordname').value = landlordName;
    document.getElementById('servicestaffname').value = servicestaffName;
    document.getElementById('tenantid').value = tenantID;
    document.getElementById('landlordid').value = landlordID;
    document.getElementById('servicestaffid').value = servicestaffID;
}


