$(document).ready(function () {
  // to showdata
  function showdata() {
    $.ajax({
      url: "show_category.php",
      method: "post",
      dataType: "json",
      success: function (data) {
        if (data) {
          x = data;
        } else {
          x = "";
        }
        output = "";
        for (i = 0; i < x.length; i++) {
          output +=
            "<tr  id='" +
            x[i].id +
            "'>" +
            "<td>" +
            x[i].name +
            "</td>" +
            "<td><button type='submit' style='margin-right:0.5vw'  data-cid=" +
            x[i].id +
            "  class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-cid=" +
            x[i].id +
            " class='btn btn-danger btn-del'>Delete</button></td>" +
            +"</tr>";
        }
        $(".category").html(output);
      },
    });
  }
  showdata();

  // insert data
  $(".idbtn").click(function (e) {
    e.preventDefault();
    let cname = $(".cname").val();
    let mydata = { name: cname };

    $.ajax({
      url: "insert_category.php",
      method: "POST",
      dataType: "json",
      data: mydata,
      success: function (data) {
        if (data.error) {
          $(".imsg").css("opacity","100");
          $(".imsg").fadeIn();
          let msg = "<p class='text-danger'>" + data.error + "</p>";
          $(".imsg").html(msg);
        } else {
          $(".imsg").css("opacity","0");
        }
        if (data.id) {
          newData =
            "<tr id='" +
            data.id +
            "'>" +
            "<td>" +
            data.name +
            "</td>" +
            "<td><button style='margin-right:0.5vw' type='submit'  data-cid=" +
            data.id +
            "  class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-cid=" +
            data.id +
            " class='btn btn-danger btn-del'>Delete</button></td>" +
            +"</tr>";
              // to reset form after submit
            $("#cform")[0].reset();
          $(".table").prepend(newData);
        }
      },
    });
  });

  // delete
  $("tbody").on("click", ".btn-del", function () {
    let cid = $(this).attr("data-cid");
    let data = { id: cid };
    mythis = this;

    // confirm
    function deleteItem() {
      if (confirm("Are you sure?")) {
        $.ajax({
          url: "delete_category.php",
          method: "POST",
          data:data,
          success: function (d) {
            if (d == 1) {
              $(mythis).closest("tr").fadeOut("slow");
            }
          },
        });
      } else {
        return false;
      }
    }
    deleteItem();
  });

  // edit
  $("tbody").on("click", ".btn-edit", function () {
    $(".mmsg").css("opacity","0");
    let cid = $(this).attr("data-cid");
    let data = { id: cid, modyfi: false };
    $.ajax({
      url: "edit_category.php",
      method: "post",
      dataType: "json",
      data:data,
      success: function (d) {
        if (d) {
          let id = d.id;
          let name = d.name;
          $(".iname").val(name);
          $(".iid").val(id);
        }
      },
    });
  });

  // modify
  $(".sbtn").click(function (e) {
    e.preventDefault();
    let mname = $(".iname").val();
    let id = $(".iid").val();
    let modyfi = true;
    let mydata = { id: id, name: mname, modyfi: modyfi };
    $.ajax({
      url: "edit_category.php",
      method: "post",
      dataType: "json",
      data:mydata,
      success: function (m) {
        if (m.error) {
          msg = "<p class='text-danger'>" + m.error + "</p>";
          $(".mmsg").css("opacity","100");
          $(".mmsg").html(msg);
        }

        if (m.id) {
          var row = $("#" + m.id + "");
          editedrow =
            "<tr id='" +
            m.id +
            "'>" +
            "<td>" +
            m.name +
            "</td>" +
            "<td><button style='margin-right:0.5vw's type='submit'  data-cid=" +
            m.id +
            "  class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-cid=" +
            m.id +
            " class='btn btn-danger btn-del'>Delete</button></td>" +
            +"</tr>";

          $(row).replaceWith(editedrow);
          $("#exampleModal").modal("hide");
          $("#mform")[0].reset();
        }
      },
    });
  });
});
