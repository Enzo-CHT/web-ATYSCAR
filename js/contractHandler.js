




function updateContract(newData) {


    $.ajax({
        url: '../php/contractModel.php',
        type: 'POST',
        data: {
            action: 'update',
            data: JSON.stringify(newData),

        },
        success: function () {
            console.log('updateContract has been executed.');
        },
        error: function (xhr, status, error) {
            console.error('Error page (addContract) : ', status, error);
        }

    })

}



function delContract() {
    $.ajax({
        url: '../php/contractModel.php',
        type: 'POST',
        data: {
            action: 'delete',
        },
        success: function () {
            console.log('delContract has been executed.');
        },
        error: function (xhr, status, error) {
            console.error('Error page (addContract) : ', status, error);
        }

    })


}