require('./bootstrap');
const ethers = require('ethers');

class App {
    constructor() {
      this.contractAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
      this.contractAbi = "";
      this.account = "";
      this.provider = "";
      this.signer = "";
      this.loggedin = false;
      this.launch();
    }
  
    async launch() {
      await this.loginWithMetaMask();
      await this.loadAbi();
      await this.contractLoadDetails();
    }
  
    async loadAbi() {
      return await fetch("/abi/NFT.json")
        .then((response) => {
          return response.json();
        })
        .then((json) => {
          this.contractAbi = json;
        });
    }
  
    async contractLoadDetails() {
      const contract = new ethers.Contract(
        this.contractAddress,
        this.contractAbi,
        this.provider
      );
      return contract;
    }
  
    async loginWithMetaMask() {
      // https://docs.metamask.io/guide/getting-started.html
      if (typeof window.ethereum !== "undefined") {
        const accounts = await ethereum.request({
          method: "eth_requestAccounts"
        });
        this.account = accounts[0];
        await this.setupProvider();
      }
    }
  
    async setupProvider() {
      this.provider = await new ethers.providers.Web3Provider(window.ethereum);
      this.signer = this.provider.getSigner();
    }
  }
  
  let web3IsHere = new App();
  