
<script>
console.log("hello 4");
</script>

<style scoped>
/* .loading {
  display: flex;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: rgba(255, 255, 255, 0.9);
}

.btnInvest {
  background-color: #100D32;
  color: yellow;
  font-weight: bold;
  display: inline-block;
  padding: 1em;
  border-radius: 0.3em;
  margin: 1em;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
} */
</style>

<script>
// change address:  0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e 
// import { ethers } from "ethers";
// export default {
//   name: "NFTInvestment",
//   data() {
//     return {
//       contract: {
//         address: "0x76d463D9CA4CAE1Fd478d62e9914A6b6Cc2b604e",
//         abi: "",
//       },
//       investmentDetails: {},
//       provider: "",
//       investors: [],
//       loading: false,
//     };
//   },
//   mounted: async function () {
//     await this.loadContractAbi();
//     await this.loadInvestmentDetails();
//   },
//   methods: {
//     async loadContractAbi() {
//       await fetch("/abi/NFT.json")
//         .then((response) => {
//           return response.json();
//         })
//         .then((data) => {
//           this.contract.abi = data.abi;
//           console.log(this.contract.abi + "hello" + data);
//         });
//     },
//     async invest() {
//       this.loading = true;
//       try {
//         await ethereum.request({ method: "eth_requestAccounts" });
//         const provider = new ethers.providers.Web3Provider(window.ethereum);
//         const signer = await provider.getSigner();
//         console.log(signer);
//         const contract = await new ethers.Contract(
//           this.contract.address,
//           this.contract.abi,
//           provider
//         );

//         const contractWitSigner = await contract.connect(signer);
//         let amountToInvest = ethers.utils.parseUnits("0.1", "ether");
//         let tx = await contractWitSigner
//           .invest("Jorre", {
//             value: amountToInvest,
//           })
//           .then()
//           .catch((err) => {
//             console.log(err.message);
//           })
//           .finally(() => {
//             this.loading = false;
//           });
//         await tx.wait();
//         console.log("Investing is done");
//         this.loading = false;
//       } catch (e) {
//         console.log(e);
//       }
//     },
//     async loadInvestmentDetails() {
//       const provider = new ethers.providers.AlchemyProvider(
//         "rinkeby",
//         "4l6fL2qthVr1j_RkV1Yns8IC2eFAI2oV"
//       );

//       const contract = new ethers.Contract(
//         this.contract.address,
//         this.contract.abi,
//         provider
//       );
//       let artistName = await contract.artistName();
//       this.investmentDetails.artistName = artistName;

//       let fundingLeftToBeDone = await contract.fundingLeftToBeDone();
//       this.investmentDetails.fundingLeftToBeDone = ethers.utils.formatEther(
//         fundingLeftToBeDone
//       );

//       let fundingRequired = await contract.fundingRequired();
//       this.investmentDetails.fundingRequired = ethers.utils.formatEther(
//         fundingRequired
//       );

//       let fundingReached = await contract.fundingGoalReached();
//       this.investmentDetails.fundingGoalReached = fundingReached;

//       let investors = await contract.getInvestors();
//       this.investors = investors;
//     },
//   },
// };
</script>