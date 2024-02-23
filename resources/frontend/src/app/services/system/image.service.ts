import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/server-response";
import {SystemImage} from "../../models/system";
import {IMAGE_DELETE, IMAGE_LISTS, IMAGE_SAVE} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class ImageService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1) {
    return this.http.post<Paginate<SystemImage>>(`${IMAGE_LISTS}?page=${page}`)
  }

  public save(postData: SystemImage) {
    return this.http.post(IMAGE_SAVE, postData)
  }

  public delete(id: number | undefined) {
    return this.http.post(IMAGE_DELETE, {id})
  }
}
