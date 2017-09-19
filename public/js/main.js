document.getElementById("add-device-btn").onclick = function ()
{
	if (document.getElementById("add-device-form").style.display === 'block') {
        document.getElementById("add-device-form").style.display = 'none';
    } else {
        document.getElementById("add-device-form").style.display = 'block';
    }
};