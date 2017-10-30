const Nightmare = require("nightmare");
const nightmare = Nightmare({ show: false });

nightmare
    .goto('https://www.reddit.com/r/news/')
    .wait('#siteTable > div:first-child .title > a')
    .evaluate(() => document.querySelector("#siteTable > div:first-child .title > a").textContent)
.end()
    .then(console.log)
    .catch((error) => {
    console.error('Search failed:', error);
});