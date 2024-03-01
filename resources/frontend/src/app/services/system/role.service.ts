import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {BehaviorSubject, debounceTime, switchMap} from "rxjs";
import {Paginate} from "../../models/server-response";
import {Role} from "../../models/system";
import {
  ROLE_CONFIG_NAVIGATION,
  ROLE_CONFIG_ROUTER,
  ROLE_DELETE,
  ROLE_ITEMS,
  ROLE_SAVE,
  ROLE_SEARCH,
  ROLE_VIEW
} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class RoleService {

  searchChange$ = new BehaviorSubject('');

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1) {
    return this.http.post<Paginate<Role>>(`${ROLE_ITEMS}?page=${page}`)
  }

  public view(id: number = 1) {
    return this.http.post<Role>(`${ROLE_VIEW}?id=${id}`)
  }

  public save(role: Role) {
    return this.http.post(ROLE_SAVE, role)
  }

  public delete(id: number | undefined) {
    return this.http.post(ROLE_DELETE, {id})
  }

  public configMenu(config: { id: number, navigation_ids: number[] }) {
    return this.http.post(ROLE_CONFIG_NAVIGATION, config)
  }

  public configRouter(config: { id: number, router_ids: number[] }) {
    return this.http.post(ROLE_CONFIG_ROUTER, config)
  }

  public search(keyword: string) {
    return this.searchChange$
      .asObservable()
      .pipe(debounceTime(500))
      .pipe(switchMap(() => this.http.post<Paginate<Role>>(ROLE_SEARCH, {keyword})));
  }
}
