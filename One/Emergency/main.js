
var flags={number:"0",email:"0",image:"0"};
function checkf() //checking first name
{
  var arr=document.getElementById("fn").value.trim();
  //var arr=name.split('');
  var flag=0;
  if(arr.length==0)
  {
    document.getElementById("pro").innerHTML="Field cant be empty";
    return "0";
  }
  for(i=0;i<arr.length;i++)
  {
    if((arr.charCodeAt(i)>=65 && arr.charCodeAt(i)<=90) || (arr.charCodeAt(i)>=97 && arr.charCodeAt(i)<=122))
    {
      flag=0;
      
    }
    else
    {
      flag=1;
      break;
    }
  }
  if(flag==1)
  {
    document.getElementById("pro").innerHTML="Special Charecters not allowed";
    return "0";
  }
  else
  {
    document.getElementById("pro").innerHTML="Valid Name";
    return "1";
  }
}
function checkl()  //checking last name
{
    var arr=document.getElementById("ln").value.trim();
    if(arr.length==0)
    {
      document.getElementById("ses").innerHTML="Field cant be empty";
      return "0";
    }
  //var arr=name.split('');
  var flag=0;
  for(i=0;i<arr.length;i++)
  {
    if((arr.charCodeAt(i)>=65 && arr.charCodeAt(i)<=90) || (arr.charCodeAt(i)>=97 && arr.charCodeAt(i)<=122))
    {
     // console.log(arr.charCodeAt(i));
      flag=0;
      
    }
    else
    {
      flag=1;
      break;
    }
  }
  if(flag==1)
  {
    document.getElementById("ses").innerHTML="Special Charecters not allowed";
    return "0";
  }
  else
  {
    document.getElementById("ses").innerHTML="Valid Name";
    return "1";
  }
}
function validAl()
{
	validAll(flags);
}
function validAll(flags)//validating all flag conditions like name,email,phone no. etc.
{
//	if(typecheck(flags)=="1" && valinumber(flags)=="1" && verify(flags)=="1")
if(typecheck(flags)=="1" && valinumber(flags)=="1" && textrim()=="1" && checkf()=="1" && checkl()=="1")
		document.getElementById("statu").innerHTML="success";
	else
		document.getElementById("statu").innerHTML="fail";
}
function textrim()//checking the subjects-marks format
{
  var lines=document.getElementById("raw").value;
  
  lines=lines.trim();
  if(lines=="")
  {
    document.getElementById("marks").innerHTML="Please Upload the marks";
    return "0";
  }
  document.getElementById("raw").value=lines;
  lines=lines.split('\n');
  //lines=lines.trim();
  var count=lines.length;
  console.log("lines="+count);
  var flag=0;
  for(i=0;i<count;i++)
  { 
    console.log("loop="+i);
    var words=lines[i].split('|');
    console.log(words.length+"hh"+i);

    if(words.length==2)
    {
      console.log("pp="+words[0]+"=pp");
      if(cformat(words[0])=="0")
      {
        flag=1;
        console.log("special charecters not allowed");
        break;
      }

      console.log("updated="+i);
      

      if(words[1].trim()=="")
      {
        flag=1;
        console.log("marks empty");
        break;
      }

      if(isNaN(words[1]))
      {
         flag=1;
         console.log("not number");
         break;
      }
      else
      {
        if(Number(words[1])>100 || Number(words[1])<0)
        {
         flag=1;
         console.log("more  than 100 or less than 0");
         break;
        }
      }
      

    }
    else
    {
       console.log(words.length);

       if(words.length!=1 )
       {
       flag=1;
       break;
     }
     else
     {
      
      if(words[0].trim!="")
      {
        console.log(words[0]);
        flag=1;
        break;
      }

     }
    }

  }
  if(flag==0)
  {
    console.log("flag0");
    document.getElementById("marks").innerHTML="Marks Format Validated";
    return 1;
  }
  else
  {
    document.getElementById("marks").innerHTML="Marks Format Wrong";
    return 0;
  }
  
}
function cformat(words)//checking the subject-name of the Subject-marks format
{
  var flag=0;
  var count=words.length;
  for(j=0;j<count;j++)
      {
        if((words.charCodeAt(j)>=65 && words.charCodeAt(j)<=90) || (words.charCodeAt(j)>=97 && words.charCodeAt(j)<=122))
        {
          //console.log("ok");
        }
        else
        {
          flag=1;
         console.log("no special charecters allowed");
         return "0";
         

        }
      }
      console.log("1 is returned");
      return "1";
}
function typechec()
{
	typecheck(flags);
}
function typecheck(verification)//checking the type of file uploaded
{
	var fulpath=document.getElementById("filetoupload").value;
  if(fulpath=="")
  {
    alert("Please upload an image");
    return "0";
  }
	var len=fulpath.length;
	var filpath=fulpath.slice(len-3);

	if(filpath=="jpg" || filpath=="png")
	{   
		verification.image="1";
		return "1";
	}
	else
	{
		verification.image="0";
		alert("invalid image");
    return "0";
	}

}
function valinumberi()
{
	valinumber(flags);
}
function valinumber(verification)//validating mobile number
{

	var number=document.getElementById("number").value;
  if(number=="")
  {
    document.getElementById("numvalstat").innerHTML="Required";
    return "0";
  }
	if(number.indexOf("+91")==0)
	{
      var filnum=number.slice(3);
      //var st=Number(filnum);
      if(isNaN(filnum)==1)
      {
      //	document.write(isNan(filnum));
      	document.getElementById("numvalstat").innerHTML="Charecters are not allowed";
      	verification.number="0";
        return "0";
        
      }
      else
      	
      {
      	if(filnum.length==10)
      	{
            verification.number="1";
        	document.getElementById("numvalstat").innerHTML="Number Validation Done";
          return "1";

      	}
        else
        {
        	document.getElementById("numvalstat").innerHTML="The number is less or more than 10 digits";
        	verification.number="0";
          return "0";
        }

      }
	}
	else
	{
		document.getElementById("numvalstat").innerHTML="Only Indian Users are allowed";
		verification.number="0";
    return "0";
	}

}
function fill()//filling the full_name field when first name and last-name fields are filled
{
console.log("triggered");
var full_name="";
if(document.getElementById("fn").value=="" || document.getElementById("ln").value=="")
 document.getElementById('fln').value="";
else
{
if(checkl()=="1" && checkf()=="1")
{
if(document.getElementById("fn").value!="" && document.getElementById("ln").value!="")
{ console.log(document.getElementById("ln").value);
	document.getElementById('fln').value=document.getElementById('fn').value.trim().toUpperCase()+" "+document.getElementById("ln").value.trim().toUpperCase();
}
else
	document.getElementById('fln').value="";
}
else
  document.getElementById('fln').value="";
}
}
function verifyy()
{
	verify(flags);
}
function verify(verification)//verifying the validity of email-address
    {
    	var email=document.getElementById("email").value;
      if(email=="")
      {
        document.getElementById("validation").innerHTML="Required";
        return "0";
      }
    	//document.write(email);
    	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    	var val=re.test(email);
       if(email.search("@gmail.com")!=-1 || email.search("rediff.com")!=-1 || email.search("@yahoo")!=-1)
       {
        document.getElementById("validation").innerHTML="Public Emails not Allowed";
        return "0";
       }
        if(val==1)
        {
             return validate(verification);
           }
         else
         {
         	document.getElementById("validation").innerHTML="Fake Email";
         	verification.email="0";
          return "0";

         }
    }
    function validate(verification)//validating the email of correct-format via ajax by mailbox api
    {
    	var email=document.getElementById("email").value;
      var status="0";
    	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = this.responseText;
                var obj1=JSON.parse(obj);
                //obj=JSON.parse(obj);
               // document.write(obj1["smtp_check"]);
               if((obj1["smtp_check"])==1)
               {

               	if( obj1["domain"]!="gmail.com" && obj1["domain"]!="hotmail.com" && obj1["domain"]!="reddif.com" && obj1["domain"]!="yahoo.com")
               	{
               	document.getElementById("validation").innerHTML="Valid Email";
               	verification.email="1";
                status="1";

               }
                else
               {
                 document.getElementById("validation").innerHTML="Public emails not allowed";
                 verification.email="0";
                 status="0";
               }
               }
               else
               {
               	document.getElementById("validation").innerHTML="Fake Email";
               	verification.email="0";
                status="0";
               }
            }
        };
        xmlhttp.open("GET", "http://apilayer.net/api/check?access_key=31eb6d3a6752cef630765be627b00370& email=" + email, false);
        xmlhttp.send();
        return status;
    }

//submitting the form via ajax
$(function(){
  var trigger=0;
  $('#testform').submit(function(event){
      if(trigger%2==0)
      {
      trigger++;
			event.preventDefault();
      console.log("triggered");
			var data = new FormData(this);
      //document.getElementById("authenticate").innerHTML="Validating Your Details,Please Wait";
			//console.log(data.get('Full_Name'));
       var numval=valinumber(flags);
       var markval=textrim(flags);
       var fval=checkf(flags);
       var lval=checkl(flags);
       var imval=typecheck(flags);
       // if(typecheck(flags)=="1" && valinumber(flags)=="1" && verify(flags)=="1")
       if(imval=="1" && numval=="1" && markval=="1" && fval=="1" && lval=="1")
        {
           document.getElementById("authenticate").innerHTML="Validation Done";
           alert("type check done");
           var obj=callaja(data);
           console.log(obj);
           if(obj=="Ok")//if(new entry is noticed)
           //if(callaja(data)=="Ok") 
         {
            pdf(data);//Resume file saved in server
            alert("Data Recorded.Duplicate copy will be downloaded");
            //trigger++;
             //ThankYou();
          //  location.reload(true);
           //window.location="filedownload.php";
           $(this).submit();//Resume file downloaded in browser by default method "filedownload.php"
          //  document.getElementById("testform").reset();
          // $('#testform').bind('submit');
           console.log("rebinded");

            document.getElementById("authenticate").innerHTML="File Downloaded.Response Recorded Successfully";
            flags.email=0; 
            flags.number=0;
            flags.image=0;
            
           document.getElementById("fn").value = "";
           document.getElementById("ln").value = "";
           document.getElementById("fln").value = "";
           document.getElementById("filetoupload").value = "";
           document.getElementById("raw").value = "";
           document.getElementById("email").value = "";
           document.getElementById("number").value = "";
           
           //ThankYou();
                    }

            else if(obj=="Updated")//if updated entry is noticed
          {
            //alert(obj);
            update(data);
            alert("Data Updated,duplicate copy will be downloaded");
            $(this).submit();
           // window.location="filedownload.php";
            console.log("holo");
            document.getElementById("authenticate").innerHTML="File Downloaded.Data updated successfully";
            document.getElementById("fn").value = "";
           document.getElementById("ln").value = "";
           document.getElementById("fln").value = "";
           document.getElementById("filetoupload").value = "";
           document.getElementById("raw").value = "";
           document.getElementById("email").value = "";
           document.getElementById("number").value = "";
           document.getElementById("pro").innerHTML="Enter Your first name";
           document.getElementById("ses").innerHTML="Enter Your last  name";
           document.getElementById("marks").innerHTML="";
           document.getElementById("numvalstat").innerHTML="";
           document.getElementById("validation").innerHTML="";
           

          }
          else
          {
            alert(obj);
            trigger++;
          }
        }
        else
        {
          if(fval==0)
            alert("Invalid First Name");
          else if(lval==0)
            alert("Invalid Last Name");
          else if(markval==0)
            alert("Invalid Marks Format");
          else if(numval==0)
            alert("Invalid Mobile Number");
          else if(imval==0)
            alert("Invalid Image Format");

          trigger++;          

        }

      }
      else
        trigger++;
       
   	
			//if(Number(flags.number)==1  && Number(flags.image)==1)
				//callaja();

			});
  });
   function ThankYou()
   {
     console.log("Entering");
     $.post("filedownload.php");
     console.log("Leaving");
    
    
   }
   function callaja(data)//function which takes the form data to process to indicate whether update or new entry is made.
   {
    var status="";
   //	var data = new FormData('#testform');
   	$.ajax({
              async:false,
              url: 'download.php',
             data: data,

            processData: false,
            contentType: false,
             type: 'POST',
             success: function(data)
             {
               status=data;
               console.log(status);
               
             }

});
      return status;
   	
   }
   function pdf(data)//function to save the resume file in server for new entry
   {
     $.ajax({
              url: 'pdf.php',
              async: false,
             data: data,
            processData: false,
            contentType: false,
             type: 'POST',
             success: function(data){
              
             }
             
});
   }
   function update(data)//function to save the resume file in server for updated entry
   {
     $.ajax({
              url: 'update.php',
              async: false,
             data: data,
            processData: false,
            contentType: false,
             type: 'POST',
             success: function(data){
              
             }
             
});
   }