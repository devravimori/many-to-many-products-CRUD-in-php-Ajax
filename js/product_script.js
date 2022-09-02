$(document).ready(function () {
  //------------ display category in form
  function categories() {
    let categorynaem = "";
    $.ajax({
      url: "show_category.php",
      dataType: "json",
      method: "post",
      success: function (categori) {
        if (categori) {
          x = categori;
        } else {
          x = "";
        }
        for (i = 0; i < x.length; i++) {
          categorynaem +=
            "<div class='form-check form-check-inline'>" +
            "<label class='form-check-label' for='ad_Checkbox1"+x[i].id +"'>" +
            "<input class='form-check-input get_value'id='ad_Checkbox1" +
            x[i].id +
            "'name='insert[]' type='checkbox' id='inlineCheckbox1' value='" +
            x[i].id +
            "'" +
            ">" +
            x[i].name +
            "</label>" +
            "</div>";
        }
        $(".displayCategory").html(categorynaem);
      },
    });
  }
  categories();
  // ---------------  to show products
  function products() {
    $.ajax({
      url: "show_products.php",
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
            "<img src='" +
            x[i].image +
            "' data-image='" +
            x[i].image +
            "' width='60vw'>" +
            "</td>" +
            "<td>" +
            x[i].name +
            "</td>" +
            "<td>" +
            x[i].price +
            "</td>" +
            "<td>" +
            x[i].catename +
            "</td>" +
            "<td><button  style='margin-right:0.5vw' type='submit' data-id='" +
            x[i].id +
            "' name='edit' class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-id='" +
            x[i].id +
            "'  name='delete' class='btn btn-danger btn-del'>Delete</button></td>" +
            "</tr>";
        }
        $(".products").html(output);
      },
    });
  }
  products();

  //--------------- delete products
  $("tbody").on("click", ".btn-del", function () {
    let pid = $(this).attr("data-id");
    let imageName = $(this).attr(" data-image");

    let data = { id: pid, image: imageName };
    mythis = this;

    // confirm box
    function deleteItem() {
      if (confirm("Are you sure?")) {
        $.ajax({
          url: "delete_product.php",
          method: "POST",
          data: data,
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


  //----------- show data in model form
  $("tbody").on("click", ".btn-edit", function () {
    //  hide invalid message in model when load it will show if errer in submit modified
    $(".nmsg").hide();
    $(".pmsg").hide();
    $(".cmsg").hide();
    $(".imdata").hide();
    $("#newFile").val("");
    let id = $(this).attr("data-id");
    let updateP = false;
    let data = { id: id, updateP: updateP };

    $.ajax({
      url: "show_product_in_model.php",
      method: "post",
      async: false,
      dataType: "json",
      data: data,
      success: function (d) {
        if (d) {
          const id = d.id;
          let name = d.name;
          let price = d.price;
          let picture = d.image;
          let category = d.category;
          $(".name").val(name);
          $(".price").val(price);
          $(".oldPicture").val(picture);
          $(".picture").attr("src", picture);
          $(".modelID").val(id);
          $(".category_in_model").html(category);
        }
      },
    });
  });

  // ---------- modify
  $("#mform").on("submit", function (e) {
    e.preventDefault();
    modelData = new FormData(this);
    $.ajax({
      url: "edit_product.php",
      method: "POST",
      dataType: "json",
      data: modelData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (newd) {
        if (newd.newID) {
          var row = $("#" + newd.newID + "");
          var test =
            "<tr id='" +
            newd.newID +
            "'>" +
            "<td>" +
            "<img src='" +
            newd.newImage +
            "' data-image='" +
            newd.newImage +
            "' width='60vw'>" +
            "</td>" +
            "<td>" +
            newd.newName +
            "</td>" +
            "<td>" +
            newd.newPrice +
            "</td>" +
            "<td>" +
            newd.catename +
            "</td>" +
            "<td><button style='margin-right:0.5vw'  type='submit' data-id='" +
            newd.newID +
            "' name='edit' class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-id='" +
            newd.newID +
            "'  name='delete' class='btn btn-danger btn-del'>Delete</button></td>" +
            "</tr>";
          row.replaceWith(test);
          $("#exampleModal").modal("hide");
        } else {
          //display invalid input
          if (newd.name) {
            $(".nmsg").fadeIn();
            let msg = "<p class='text-danger'>" + newd.name + "</p>";
            $(".nmsg").html(msg);
          } else {
            $(".nmsg").fadeOut();
          }

          if (newd.price) {
            $(".pmsg").fadeIn();
            let msg = "<p class='text-danger'>" + newd.price + "</p>";
            $(".pmsg").html(msg);
          } else {
            $(".pmsg").fadeOut();
          }

          if (newd.category) {
            $(".cmsg").fadeIn();
            let msg = "<p class='text-danger'>" + newd.category + "</p>";
            $(".cmsg").html(msg);
          } else {
            $(".cmsg").fadeOut();
          }
          if (newd.image) {
            $(".imdata").fadeIn();
            let msg = "<p class='text-danger'>" + newd.image + "</p>";
            $(".imdata").html(msg);
          } else {
            $(".imdata").fadeOut();
          }
        }
      },
    });
  });

  // ------   insert
  $("#cform").on("submit", function (e) {
    e.preventDefault();

    newproduct = "";
    data = new FormData(this);

    $.ajax({
      url: "insert_product.php",
      method: "POST",
      dataType: "json",
      aync: false,
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (d) {

        // display error
        if (d.price) {
          $(".pdata").css("opacity", "100");
          $(".pdata").fadeIn();
          let msg = "<p class='text-danger'>" + d.price + "</p>";
          $(".pdata").html(msg);
        } else {
          $(".pdata").css("opacity", "0");
        }
        if (d.name) {
          $(".pndata").css("opacity", "100");
          $(".pndata").fadeIn();
          let msg = "<p class='text-danger'>" + d.name + "</p>";
          $(".pndata").html(msg);
        } else {
          $(".pndata").css("opacity", "0");
        }
        if (d.category) {
          $(".cdata").css("opacity", "100");
          $(".cdata").fadeIn();
          let msg = "<p class='text-danger'>" + d.category + "</p>";
          $(".cdata").html(msg);
        } else {
          $(".cdata").css("opacity", "0");
        }
        if (d.image) {
          $(".idata").css("opacity", "100");
          $(".idata").fadeIn();
          let msg = "<p class='text-danger'>" + d.image + "</p>";
          $(".idata").html(msg);
        } else {
          $(".idata").css("opacity", "0");
        }

        // ADD NEW ROW
        if (d.pid) {
          $("#cform")[0].reset();
          newproduct +=
            "<tr id='" + d.pid + "'>" +
            "<td>" +
            "<img src='" +
            d.newImage +
            "' data-image='" +
            d.newImage +
            "' width='60vw'>" +
            "</td>" +
            "<td>" +
            d.newName +
            "</td>" +
            "<td>" +
            d.newPrice +
            "</td>" +
            "<td>" +
            d.categoryinserted +
            "</td>" +
            "<td><button style='margin-right:0.5vw'  type='submit' data-id='" +
            d.pid +
            "' name='edit' class='btn btn-primary btn-edit' data-toggle='modal' data-target='#exampleModal'>Edit</button>" +
            "<button type='submit' data-id='" +
            d.pid +
            "'  name='delete' class='btn btn-danger btn-del'>Delete</button></td>" +
            "</tr>";
          $(".pdata").css("opacity", "0");
          $(".pndata").css("opacity", "0");
          $(".idata").css("opacity", "0");
          $(".cdata").css("opacity", "0");
          $(".table").prepend(newproduct);
        }
      },
    });
  });
});
