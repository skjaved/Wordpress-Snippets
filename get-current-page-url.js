/**
 * This function will return the current
 * page url on live and local environment
 */
function base_url() {
	var pathparts = location.pathname.split("/");
	var url;
	if (location.host == "localhost") {
		url = location.origin + "/" + pathparts[1].trim("/") + "/"; // http://localhost/example/
	} else {
		url = location.origin; // https://example.in
	}
	return url;
}