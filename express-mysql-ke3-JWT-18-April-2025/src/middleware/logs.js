// const logRequest = (req, res, next) => {
//     console.log('Riquest ke PATH : ', req.path);
//     next();
// }

const logRequest = (req, res, next) => {
    const now = new Date();
    
    const year   = now.getFullYear();
    const month  = String(now.getMonth() + 1).padStart(2, '0');
    const day    = String(now.getDate()).padStart(2, '0');
    const hour   = String(now.getHours()).padStart(2, '0');
    const minute = String(now.getMinutes()).padStart(2, '0');
    const second = String(now.getSeconds()).padStart(2, '0');

    const timeStamp = `[${year}-${month}-${day} ${hour}:${minute}:${second}]`;
    const method = req.method;
    const path = req.path;
    const ip = req.ip;

    console.log(`${timeStamp} M: ${method} P: ${path} IP: ${ip}`);

    next();
}

module.exports = logRequest;
