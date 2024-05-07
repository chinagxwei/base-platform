import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {SystemTag} from "../../models/system";
import {TAG_DELETE, TAG_LIST, TAG_SAVE, TAG_VIEW} from "../../api/system.api";
import {Paginate} from "../../models/server-response";

@Injectable({
  providedIn: 'root'
})
export class TagService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemTag) {
    return this.http.post<Paginate<SystemTag>>(`${TAG_LIST}?page=${page}`, query)
  }

  public save(postData: SystemTag) {
    return this.http.post(TAG_SAVE, postData)
  }

  public view(id: number) {
    return this.http.post<SystemTag>(TAG_VIEW, {id})
  }

  public delete(id: number | undefined) {
    return this.http.post(TAG_DELETE, {id})
  }
}
