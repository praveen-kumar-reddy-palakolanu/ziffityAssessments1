$(document).ready(function() {
    var blocks = $(".block");
    var userDetails = localStorage.getItem("users");
    var clickedBlocks = localStorage.getItem("clickedBlocks");
 
    var clickedBlocksArray = [];

    if (clickedBlocks) {
        clickedBlocksArray = JSON.parse(clickedBlocks);
    }

    clickedBlocksArray.forEach(function(clickedBlock) {
        var blockIndex = clickedBlock.blockIndex;
        blocks.eq(blockIndex).addClass("clicked");
    });

    blocks.on("click", function() {
        $(this).toggleClass("clicked");

        var clickedBlocksArray = [];

        clickedBlocksArray = JSON.parse(localStorage.getItem("clickedBlocks") || "[]");

        var blockIndex = blocks.index($(this));

        var existingBlock = clickedBlocksArray.find(function(clickedBlock) {
            return clickedBlock.blockIndex === blockIndex;
        });

        if (existingBlock) {
            clickedBlocksArray = clickedBlocksArray.filter(function(clickedBlock) {
                return clickedBlock.blockIndex !== blockIndex;
            });
        } 
        else {
            var phoneNumbers = $("#phoneNumber").val();
            var vehicleNos = $("#vehicleNo").val();
            
            var newBlock = {
                userDetails: userDetails,
                blockIndex: blockIndex,
                time: new Date().getTime(),
                phoneNumbers: phoneNumbers,
                vehicleNos: vehicleNos
            };
            clickedBlocksArray.push(newBlock);
        }
        localStorage.setItem("clickedBlocks", JSON.stringify(clickedBlocksArray));
    });

    var dataContainer = $("#dataContainer");

    clickedBlocksArray.forEach(function(clickedBlock) {
        var blockIndex = clickedBlock.blockIndex;
        var phoneNumbers = clickedBlock.phoneNumbers;
        var vehicleNos = clickedBlock.vehicleNos;

        var data = "<p>Block Index: " + blockIndex + ", Phone Numbers: " + phoneNumbers + ", Vehicle Numbers: " + vehicleNos + "</p>";
        dataContainer.append(data);
    });
});
