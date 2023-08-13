const fs = require('fs')
const chalk = require('chalk')

global.apikey = 'isi apikey lu'
global.rosekey = '-' //https://api.itsrose.life
//—————「 Set Nama Bot & Own 」—————//
global.namabot = '𝕲𝖗𝖊𝖌𝖔𝖗𝖎𝖚𝖘-𝕭𝖔𝖙'
global.namaowner = '𝕲𝖗𝖊𝖌𝖔𝖗𝖎𝖚𝖘'

//—————「 Setting Owner 」—————//
global.owner = '62895388290404'
global.nomorlu = '62895388290404'
global.ownernomer = ["62895388290404"]
global.premium = ['62895388290404']

//—————「 Set Wm 」—————//
global.packname = '𝕲𝖗𝖊𝖌𝖔𝖗𝖎𝖚𝖘-𝕭𝖔𝖙'
global.author = '𝕲𝖗𝖊𝖌𝖔𝖗𝖎𝖚𝖘'
global.prefa = ['', '.']
global.sp = '•'

//—————「 Set Message 」—————//
global.mess = {
    done: 'Done ✅',
    admin: 'Feature Only for _*Admin Group*_',
    botAdmin: 'Perintah Ini Hanya Bisa Digunakan Ketika Bot Menjadi Admin Group !',
    owner: 'Feature Only for _*owner*_',
    group: 'Feature Only for _*Group Chat*_',
    private: 'Feature Only for _*Admin Group*_',
    wait: 'Wait a Moment, for Process',
    endLimit: 'Your imit has run out, Wait at 12 at night',
    error: '*!!!Feature Error!!!*',
}

//—————「 Set Limit 」—————//
global.limitawal = {
    premium: "Infinity",
    free: 25,
}

//—————「 Set Image 」—————//
global.imageurl = 'https://i.ibb.co/LgWsTJC/1685442424826.jpg'
global.isLink = `https://youtube.com/@GREGOR1US`
global.thumb = fs.readFileSync('./media/thumb.jpg')

//—————「 Batas Akhir 」—————//
let file = require.resolve(__filename)
fs.watchFile(file, () => {
    fs.unwatchFile(file)
    console.log(chalk.redBright(`Update'${__filename}'`))
    delete require.cache[file]
    require(file)
})
