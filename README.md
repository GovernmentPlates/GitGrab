<h1>GitGrab</h1>
	Grab a GitHub users email address from their GitHub username
	<h3>Requirements</h3>
	<p>PHP 5.0 (or higher) with cURL</p>
	<h3>How to use GitGrab</h3>
	<p>Once installed, you can use GitGrab by visiting your webserver (for example: <code>https://yourweb.server/gitgrab.php</code>).</p>
	<p>To make a request to GitGrab, you'll need to specify the username in the URL: <code>https://yourweb.server/gitgrab.php[GITHUB-USERNAME]</code></p>
	<p>After you've made a request, GitGrab will return the Email address (if found) in JSON: <code>{"searchQuery":"someonesgithubaccount","unixTimestamp":1507548208,"emailAddress":"github@example.com"}</code></p>