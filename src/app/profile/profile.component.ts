import { Component, OnInit } from '@angular/core';
import { HttpParams, HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';

interface profilePostResponse {
  name: string,
  email: string
}

class User {
  constructor(
    public name: string,
    public email: string
  ) { }
}

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user: User;
  showItems: boolean;
  editingBool: boolean;
  editing: string;

  url = "/db2nb/connectuva/"

  constructor(private http: HttpClient, private route: ActivatedRoute) {
    this.editingBool = false;
    this.editing = "false";
    this.user = new User("Loading...", "Loading...");
    this.showItems = true;
  }
  // ngOnInit(): void {
  //   this.route.queryParams.subscribe(params => {
  //     if (params["id"]) {
  //       this.http.post<profilePostResponse>("http://localhost/connectuva/api/getProfileAng/" /* URL NEEDS TO BE CHANGED DEPENDING ON WHERE YOU CALL API*/, params).subscribe(
  //         response => {
  //           console.log("name", response.name);
  //           console.log("email", response.email);
  //           this.showItems = response.name != undefined && response.email != undefined;
  //           this.user.name = response.name == "" ? "We couldn't find your user information" : response.name;
  //           this.user.email = response.email == "" ? "We couldn't find your user information" : response.email;
  //           console.log(this.showItems);
  //         },
  //         error => {
  //           this.name = "";
  //           this.email = "";
  //           console.log("error", error);
  //         }
  //       );
  //     }
  //   });
  // }
  ngOnInit(): void {
    this.http.get<profilePostResponse>(this.url + "api/getProfile/").subscribe(
      response => {
        if (response.name == undefined || response.email == undefined) {
          window.location.href = this.url + "index/";
        }
        // Can be refactored if wanted
        this.showItems = response.name != undefined && response.email != undefined;
        this.user.name = response.name == "" ? "We couldn't find your user information" : response.name;
        this.user.email = response.email == "" ? "We couldn't find your user information" : response.email;
      },
      error => {
        console.log("error", error);
        window.location.href = this.url + "index/";
      }
    );
  }


  toggleEditing(): void {
    this.editing = this.editingBool ? "false" : "true";
    this.editingBool = !this.editingBool;
  }

  submitForm(data: any): void {
    this.toggleEditing();
    this.http.post(this.url + "api/editProfile", data).subscribe(
      response => {
        console.log(response);
      }
    );
  }

  deleteProfile(): void {
    this.http.post(this.url + "api/delProfile/", { "delete": 1 }).subscribe(
      response => {
        console.log(response);
        window.location.href = this.url + "index/";
      },
      error => {
        console.log(error);
        window.location.href = this.url + "index/";
      }
    );
  }


}
