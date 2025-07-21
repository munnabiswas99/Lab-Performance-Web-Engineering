console.log("Hello, World!");



let students = [
    {name: "Munna Biswas", id: 5261, attendance:false, scores:[{subject: "Math", score: 50}, {subject: "Bangla", score: 60}, {subject: "English", score: 70}]},
    {name: "Habib", id: 5174, attendance:true, scores:[{subject: "Math", score: 80}, {subject: "Bangla", score: 70}, {subject: "English", score: 90}]},
    {name: "Maruf", id: 5364, attendance:true, scores:[{subject: "Math", score: 60}, {subject: "Bangla", score: 50}, {subject: "English", score: 70}]}
]

for (let i = 0; i < students.length; i++) {
    // console.log(`Name: ${students[i].name}, Attendance: ${students[i].attendance} Scores: ${students[i].scores}`);
    if(students[i].attendance==true){
        let totalScore = 0;
        for (let j = 0; j < students[i].scores.length; j++) {
            totalScore = totalScore + students[i].scores[j].score;
        }
        console.log(`Total Score: ${totalScore}`);

    }
    else{
        console.log("Not Eligible");
    }

}



