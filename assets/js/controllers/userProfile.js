class UserProfile {

  static init(){
    UserProfile.getProfileDetails();
  }

  static getProfileDetails(){

        $("#profile-table").DataTable({
        processing : true,
        serverSide : true,
        bDestroy: true,
        pagingType: "simple",
        lengthChange: false,
        searching: false,
        ordering: false,
        preDrawCallback : function( settings ) {
          if (settings.aoData.length < settings._iDisplayLength){
            settings._iRecordsTotal=0;
            settings._iRecordsDisplay=0;
          }else{
            settings._iRecordsTotal=100000;
            settings._iRecordsDisplay=100000;
          }
        },
        responsive: true,
        ajax : {
          url: "api/person/profile",
          type: "GET",
          beforeSend: function(xhr){xhr.setRequestHeader('Authentication', localStorage.getItem("token"))},
          dataSrc : function(resp){
            return resp;
          },
          data : function ( d ) {
            console.log(d);
          }
        },
        columns : [
            { "data": "id",
              "render": function ( data ) {
                return '<div><span class="badge">'+data+'</div>';
              }
            },
            { "data": "name" },
            { "data": "surname" },
            { "data": "email" }
        ]
      });
  }

}
