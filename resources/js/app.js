require('./bootstrap');
const ethers = require('ethers');

console.log('started appjs');

let tempelement = document.getElementById('nftImage');
// let mintButton = document.getElementById('mintButton');
// let eth = document.getElementById('ethPrice');


// let userId = tempelement.getAttribute('data-user-id');
// let userFirstname = tempelement.getAttribute('data-user-firstname');
let nfts = tempelement.getAttribute('data-nfts');

// let ethPrice = eth.getAttribute('data-eth-price');

// let arrayNfts = JSON.parse(nfts);


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
      // this.loadMintNFT(temp);
      // console.log(temp);
      // await this.mintButtonClick();
    }
    

    loadMintNFT(temp) {
      document.querySelector(".btn--mint").addEventListener("click", function(){
        console.log("Hold on, about to mint nft");

        // connect via MetaMask
        const provider = new ethers.providers.Web3Provider(window.ethereum);
        // Sign via MetaMask (use the selected account)
        const signer = provider.getSigner();
  
        // The address of our contract to talk to
        const daiAddress = "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e";
  
        // The human readible representation the contract
        const daiAbi = temp;

        console.log(daiAbi);
        // The Contract object we can work with
        const contract = new ethers.Contract(daiAddress, daiAbi, provider);
  
        // Connect the signer, or replace provider with signer when instantiating the contract object
        let contractWithSigner = contract.connect(signer);
  
        // call the methods
        // for (let i = 0; i < arrayNfts.length; i++){
        //   if(userId == arrayNfts[i]['creator_id']){
        //     console.log('succesvol'+ " "  + arrayNfts[i]['image_file_path'] + " " +  ethPrice * arrayNfts[i]['price']);
        //     let imagePath = arrayNfts[i]['image_file_path'];
            // let price = ethPrice * arrayNfts[i]['price'];
        // ethers.utils.parseUnits(price, "ether");
            let tx = contractWithSigner.mintNFT(
              "path",
              "33"
            );
            console.log(tx);
          // }
        // }
        console.log("The NFT was minted! 🎉");

      });
    }

    // async mintButtonClick(){
    //   mintButton.addEventListener("click", function (){
    //       loadMintNFT();
    //   });
    // }
  
    // throwConfetti() {
    //   // Pass in the id of an element
    //   confetti({
    //     particleCount: 100,
    //     spread: 70,
    //     origin: { y: 0.6 }
    //   });
    // }
  
    // setupEvents() {
    //   document
    //     .querySelector(".btn--mint")
    //     .addEventListener("click", this.invest.bind(this));
  
    //   const contract = new ethers.Contract(
    //     this.contractAddress,
    //     this.contractAbi,
    //     this.provider
    //   );
  
    //   contract.on("Investment", (from, value) => {
    //     this.logToConsole(
    //       `New investment from ${from} for ${ethers.utils.formatEther(value)}`
    //     );
    //     this.throwConfetti();
    //   });
  
    //   contract.on("Payout", (value) => {
    //     this.logToConsole(
    //       `Payout done by Chainify for ${ethers.utils.formatEther(value)}`
    //     );
    //     this.throwConfetti();
    //   });
    // }
  
    // async invest() {
    //   try {
    //     console.log("Loading the contract code.");
    //     const contract = new ethers.Contract(
    //       this.contractAddress,
    //       this.contractAbi,
    //       this.provider
    //     );
    //     // this.showLoading();
    //     const contractWithSigner = await contract.connect(this.signer);
    //     const tx = await contractWithSigner
    //       .invest(userFirstname, {
    //         value: ethers.utils.parseEther("0.2")
    //       })
    //       .catch((e) => {
    //         if (e.message.includes("You can only invest once")) {
    //           console.log("You can only invest once.");
    //         } else {
    //           console.log("Something went wrong there...");
    //         }
    //         // this.hideLoading();
    //       });
    //     await tx.wait();
    //     // this.hideLoading();
    //     console.log("Congrats! You are now an investor!");
    //   } catch (e) {}
    // }
  
    async loadAbi() {
      console.log("Loading the contract code.");
      return await fetch("/abi/NFT.json")
        .then((response) => {
          return response.json();
        })
        .then((json) => {
          this.contractAbi = json;
          console.log(this.contractAbi);
          console.log("Contract loaded, you can now invest. 😎");
        });
    }
  
    async contractLoadDetails() {
      console.log("Loading contract details.");
      const contract = new ethers.Contract(
        this.contractAddress,
        this.contractAbi,
        this.provider
      );
  
    //   const isForSale = await contract.isForSale();
    //   document.querySelector(".investment__forsale").innerHTML = isForSale;
  
    //   const putUpForSale = await contract.putUpForSale();
    //   document.querySelector(".investmentAmountRequired").innerHTML =
    //     ethers.utils.formatEther(investmentRequired) + " ETH";
  
    //   const investmentLeft = await contract.artistInvestmentStillRequired();
    //   document.querySelector(".investmentAmountLeft").innerHTML =
    //     ethers.utils.formatEther(investmentLeft) + " ETH";
  
    //   const nrOfInvestors = await contract.nrOfInvestors();
    //   document.querySelector(".investmentNumber").innerHTML = nrOfInvestors;
  
      console.log("Ready when you are.");
      return contract;
    }
  
    async loginWithMetaMask() {
      // https://docs.metamask.io/guide/getting-started.html
      if (typeof window.ethereum !== "undefined") {
        const accounts = await ethereum.request({
          method: "eth_requestAccounts"
        });
        this.account = accounts[0];
        console.log(`Cool, we're connected to ${this.account}`);
        await this.setupProvider();
      }
    }
  
    async setupProvider() {
      this.provider = await new ethers.providers.Web3Provider(window.ethereum);
      this.signer = this.provider.getSigner();
    }
  
    // showLoading() {
    //   // show the loading screen
    //   document.querySelector(".loading").style.visibility = "visible";
    // }
  
    // hideLoading() {
    //   // hide the loading screen
    //   document.querySelector(".loading").style.visibility = "hidden";
    // }
  
    // logToConsole() {
    //   // log a message on screen
    //   var msg = "Set message";
    //   document.querySelector(".message").innerHTML = msg;
    // }
  }
  
  let web3IsHere = new App();
  