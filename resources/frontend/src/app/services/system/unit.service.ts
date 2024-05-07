import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {SystemUnit} from "../../models/system";
import {Paginate} from "../../models/server-response";
import {UNIT_DELETE, UNIT_LIST, UNIT_SAVE, UNIT_VIEW} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class UnitService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemUnit | { title: string }) {
    return this.http.post<Paginate<SystemUnit>>(`${UNIT_LIST}?page=${page}`, query)
  }

  public save(postData: SystemUnit) {
    return this.http.post(UNIT_SAVE, postData)
  }

  public view(id: number) {
    return this.http.post<SystemUnit>(UNIT_VIEW, {id})
  }

  public delete(id: number | undefined) {
    return this.http.post(UNIT_DELETE, {id})
  }
}
