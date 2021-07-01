module.exports = {
  transpileDependencies: ["vuetify"],

  devServer: {
    proxy: "https://akm.net.ua/",
  },

  outputDir: "../public",
  indexPath:
    process.env.NODE_ENV === "production"
      ? "../resources/views/index.blade.php"
      : "index.html",
};
