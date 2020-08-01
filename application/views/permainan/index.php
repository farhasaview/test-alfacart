<div class="container">
	<marquee direction=left><h3>Selamat Datang di Soal Permainan&nbsp;<span class="glyphicon glyphicon-flag"></span></h3></marquee>
</div>
<script type="text/javascript">
	var userScore = [];
	var aiScore = [];
	// tempat untuk inputan user
	var a=prompt("Input jumlah deret dari 10 s/d 20, dengan bilangan genap");
	// variabel untuk menentukan apakah inputan user adalah bilangan genap
	hasil=a % 2;
	// jika user tidak input apa-apa
	if (a!='') {
	// jika bukan bilangan genap
	if (hasil==0) {
	//jika user input angka bilangan genap meneruskan dari if diatas, dan angka adalah 10 s/d 20
		if (a<=20 && a>=10) {
			function rand(min, max) {
				let randomNum = Math.random() * (max - min) + min;
				return Math.floor(randomNum);
			}
			var b1=rand(10,20);
			var b2=rand(10,20);
			var b3=rand(10,20);
			var b4=rand(10,20);
			var b5=rand(10,20);
			var b6=rand(10,20);
			var b7=rand(10,20);
			var b8=rand(10,20);
			var b9=rand(10,20);
			var b10=rand(10,20);
			var listNumbers=[b1,b2,b3,b4,b5,b6,b7,b8,b9,b10];
			do {
				var userBil=prompt("List : "+listNumbers+"\npick a number from most left or right\n*Jika angka most left & most right sama, maka default adalah most left");
				if (userBil == '') {
					alert("kamu tidak menginput\nikuti aturan main untuk menghabiskan angkanya");
				} else {
					if (userBil == listNumbers[0]) {
						var userPick = listNumbers[0];
						// kumpulkan nilai pick kedalam array userScore
						userScore.push(userPick);
						// hapus array paling kiri
						listNumbers.shift();
						// pick nilai paling awal
						var aiPick = listNumbers[0];
						// kumpulkan nilai pick kedalam array aiScore
						aiScore.push(aiPick);
						listNumbers.shift();
						// hitung score user
						var sumUserScore = userScore.reduce(function(a, b){
							return a + b;
							}, 0);
						// hitung score ai
						var sumAiScore = aiScore.reduce(function(a, b){
							return a + b;
							}, 0);
						alert("you pick "+userPick+"\nAI pick "+aiPick+"\nsum User : "+sumUserScore+"\nsum AI : "+sumAiScore);
					} else if(userBil == listNumbers[listNumbers.length - 1]) {
						var userPick = listNumbers[listNumbers.length - 1];
						userScore.push(userPick);
						// hapus array paling kanan
						listNumbers.pop();
						// pick nilai paling akhir
						var aiPick = listNumbers[listNumbers.length - 1];
						aiScore.push(aiPick);
						listNumbers.pop();
						// hitung score user
						var sumUserScore = userScore.reduce(function(a, b){
							return a + b;
							}, 0);
						// hitung score ai
						var sumAiScore = aiScore.reduce(function(a, b){
							return a + b;
							}, 0);
						alert("you pick "+userPick+"\nAI pick "+aiPick+"\nsum User : "+sumUserScore+"\nsum AI : "+sumAiScore);
					} else {
						alert("Kamu tidak mengikuti aturan mainnya\nikuti aturan main untuk menghabiskan angkanya");
					}
				}
				// lakukan looping permainan selama angkanya masih ada atau selama angkanya belum habis
			} while (listNumbers.length > 0)
			if (sumUserScore < sumAiScore) {alert("game over, you lose");}
			else if (sumAiScore < sumUserScore) {alert("you win");}
			else {alert("pertandingan seri");}
		} else {
			// jika inputan bukan bilangan genap dan inputan diluar dari angka 10 sampai 20 maka alert ini dijalankan
			alert("Harap input angka dari angka 10 sampai 20 dengan bilangan genap")
		}
	} else {
		// jika user tidak input bilangan genap maka alert ini dijalankan
		alert("Kamu tidak input angka bilangan genap silahkan refresh untuk memulai kembali permainan");
	}
} else {
// jika user tidak input apa-apa maka alert ini dijalankan
	alert("kamu tidak input apa pun silahkan refresh untuk memulai kembali permainan");
}
</script>